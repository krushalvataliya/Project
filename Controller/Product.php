<?php 
require_once 'Controller/Core/Action.php';

/**
 * 
 */
class Controller_Product extends Controller_Core_Action
{
	public function gridAction()
	{	
		require_once 'View/product/grid.phtml';
	}
	public function addAction()
	{
		require_once 'View/product/add.phtml';
	}
	public function editAction()
	{
		require_once 'View/product/edit.phtml';
	}
	public function insertAction()
	{
		$request = $this->getRequest();
		$product = $request->getPost('product');
		$sql = "INSERT INTO `products` (`product_id`, `sku`, `cost`, `price`, `quantity`, `description`, `status`, `color`, `material`, `created_at`, `updated_at`)
		 	VALUES ('$product[product_id]',  '$product[sku]', '$product[cost]','$product[price]', '$product[quantity]', '$product[description]', '$product[status]', '$product[color]', '$product[material]', current_timestamp(), NULL)";
		$adapter =$this->getAdapter();
		$insert=$adapter->insert($sql);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=product");
	}
	public function deleteAction()
	{
		$request = $this->getRequest();
		$sql ="DELETE FROM `products` WHERE `products`.`product_id` = {$request->getParam('product_id')}";
		 $adapter =$this->getAdapter();
		$delete = $adapter->delete($sql);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=product");
	}
	public function updateAction()
	{
		$request = $this->getRequest();
		$product = $request->getPost('product');
		 $sql ="SELECT * 
		        FROM `products`
		        WHERE `product_id`= $product[product_id];";
		 $adapter =$this->getAdapter();

		$productr=$adapter->fetchRow($sql);

		if(!$productr){
			throw new Exception("Error Processing Request", 1);
		}

		$sql= "UPDATE `products` 
		 		SET `sku` ='$product[sku]', `cost` = '$product[cost]', `price` ='$product[price]', `quantity` = '$product[quantity]', `description` = '$product[description]', `status` = '$product[status]', `color`= '$product[color]', `material` = '$product[material]',`updated_at`=current_timestamp()
		 		WHERE `products`.`product_id` = $product[product_id];";

		$update = $adapter->update($sql);
		print_r($update);

		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=product");
	}

	
}

?>
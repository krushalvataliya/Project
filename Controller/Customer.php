<?php 
require_once 'Controller/Core/Action.php';

/**
 * 
 */
class Controller_Customer extends Controller_Core_Action
{
	public function gridAction()
	{
		require_once 'View/customer/grid.phtml';
	}
	public function addAction()
	{
		require_once 'View/customer/add.phtml';
	}
	public function editAction()
	{
		require_once 'View/customer/edit.phtml';
	}
	public function insertAction()
	{
		$request = $this->getRequest();
		$customer = $request->getPost('customer');
		$customer_address = $request->getPost('customer_address');
		$sql="INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `created_at`, `updated_at`) VALUES ('$customer[customer_id]', '$customer[first_name]', '$customer[last_name]', '$customer[email]', '$customer[gender]', '$customer[mobile]', '$customer[status]', current_timestamp(), NULL);";
				$adapter =$this->getAdapter();
		$insert=$adapter->insert($sql);
		if (!$insert) {
			throw new Exception("Error Processing Request", 1);
		}
		 $sql2 = "INSERT INTO `customer_address` (`address`, `city`, `state`, `country`, `zip_code`, `created_at`, `updated_at`, `customer_id`)
		 			VALUES ('$customer_address[address]', '$customer_address[city]', '$customer_address[state]', '$customer_address[country]', '$customer_address[zip_code]', current_timestamp(), NULL, '$insert');";
		$insert2=$adapter->insert($sql2);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=customer");
	}
	public function deleteAction()
	{
		$request = $this->getRequest();
		$sql ="DELETE FROM `customers` WHERE `customers`.`customer_id` = {$request->getParam('customer_id')}";
		$adapter =$this->getAdapter();
		$delete = $adapter->delete($sql);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=customer");
	}
	public function updateAction()
	{
		$request = $this->getRequest();
		$customer = $request->getPost('customer');
		$sql ="SELECT * 
		        FROM `customers`
		        WHERE `customer_id`= $customer[customer_id];";
		$adapter =$this->getAdapter();
		$result=$adapter->fetchRow($sql);
		if(!$result){
			throw new Exception("Error Processing Request", 1);
		}
		$sql="UPDATE `customers` 
			SET `first_name` = '$customer[first_name]', `last_name` = '$customer[last_name]', `email` = '$customer[email]', `gender` = '$customer[gender]', `mobile` = '$customer[mobile]', `status` = '$customer[status]', `updated_at` = current_timestamp() 
			WHERE `customers`.`customer_id` = $customer[customer_id];";
		$update = $adapter->update($sql);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=customer");
	}
}

?>
<?php 
require_once 'Controller/Core/Action.php';
/**
 * 
 */
class Controller_Customer_Address extends Controller_Core_Action
{
	public function gridAction()
	{
		require_once 'View/customer_address/grid.phtml';
	}

	public function editAction()
	{
		require_once 'View/customer_address/edit.phtml';
	}
	
	public function updateAction()
	{
		$request = $this->getRequest();
		$customer_address = $request->getPost('address');
		$sql ="SELECT * FROM `customer_address` WHERE `customer_id`= $customer_address[customer_id]";
		$adapter =$this->getAdapter();
		$result=$adapter->fetchRow($sql);
		if(!$result){
			throw new Exception("Error Processing Request", 1);
		}
		$sql="UPDATE `customer_address`SET `address` = '$customer_address[address]', `city` = '$customer_address[city]', `state` = '$customer_address[state]', `country` = '$customer_address[country]',`zip_code` = '$customer_address[zip_code]',`updated_at` = current_timestamp() WHERE `customer_address`.`customer_id` =$customer_address[customer_id] ";
		$update = $adapter->update($sql);
		print_r($update);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=customer_address&customer_id=$customer_address[customer_id]");
	}

}

?>
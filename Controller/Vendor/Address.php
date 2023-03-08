<?php 
require_once 'Controller/Core/Action.php';

/**
 * 
 */
class Controller_Vendor_Address extends Controller_Core_Action
{
	public function gridAction()
	{
		require_once 'View/vendor_address/grid.phtml';
	}

	public function editAction()
	{
		require_once 'View/vendor_address/edit.phtml';
	}
	
	public function updateAction()
	{
		$request = $this->getRequest();
		$vendor_address = $request->getPost('address');
		$sql ="SELECT * FROM `vendor_address` WHERE `vendor_id`= $vendor_address[vendor_id]";
		$adapter =$this->getAdapter();
		$result=$adapter->fetchRow($sql);
		if(!$result){
			throw new Exception("Error Processing Request", 1);
		}
		$sql="UPDATE `vendor_address`SET `address` = '$vendor_address[address]', `city` = '$vendor_address[city]', `state` = '$vendor_address[state]', `country` = '$vendor_address[country]',`zip_code` = '$vendor_address[zip_code]',`updated_at` = current_timestamp() WHERE `vendor_address`.`vendor_id` =$vendor_address[vendor_id] ";
		$update = $adapter->update($sql);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=vendor_address&vendor_id=$vendor_address[vendor_id]");

	}

}

?>
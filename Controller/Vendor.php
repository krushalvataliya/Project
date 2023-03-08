<?php 
require_once 'Controller/Core/Action.php';
/**
 * 
 */
class Controller_Vendor extends Controller_Core_Action
{
	public function gridAction()
	{
		require_once 'View/vendor/grid.phtml';
	}
	public function addAction()
	{
		require_once 'View/vendor/add.phtml';
	}
	public function editAction()
	{
		require_once 'View/vendor/edit.phtml';
	}
	public function insertAction()
	{
		$request = $this->getRequest();
		$vendor = $request->getPost('vendor');
		$address = $request->getPost('vendor_address');
		$sql = "INSERT INTO `vendors` (`vendor_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `company`, `created_at`, `updated_at`) 
				VALUES ('$vendor[vendor_id]', '$vendor[first_name]', '$vendor[last_name]', '$vendor[email]', '$vendor[gender]', '$vendor[mobile]', '$vendor[status]', '$vendor[company]', current_timestamp(), NULL)";
		$adapter =$this->getAdapter();
		$insert=$adapter->insert($sql);
		if (!$insert) {
			throw new Exception("Error Processing Request", 1);
		}
		$sql2 = "INSERT INTO `vendor_address` (`address`, `city`, `state`, `country`, `zip_code`, `created_at`, `updated_at`, `vendor_id`)
		 		VALUES ('$address[address]', '$address[city]', '$address[state]', '$address[country]', '$address[zip_code]', current_timestamp(), NULL, '$insert');";
		$insert2=$adapter->insert($sql2);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=vendor");
	}
	public function deleteAction()
	{
		$request = $this->getRequest();
		$adapter =$this->getAdapter();
		$sql ="DELETE FROM `vendors` WHERE `vendors`.`vendor_id` = {$request->getParam('vendor_id')}";
		$delete = $adapter->delete($sql);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=vendor");
	}
	public function updateAction()
	{
		$request = $this->getRequest();
		$vendor = $request->getPost('vendor');
			$sql ="UPDATE `vendors` SET `first_name` = '$vendor[first_name]', `last_name` = '$vendor[last_name]', `email` = '$vendor[email]', `gender` = '$vendor[gender]', `mobile` = '$vendor[mobile]', `status` = '$vendor[status]', `company` = '$vendor[company]',`updated_at` = current_timestamp() WHERE `vendors`.`vendor_id` = $vendor[vendor_id];";
		$adapter =$this->getAdapter();
		 $update = $adapter->update($sql);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=vendor");
	}
	
}

?>
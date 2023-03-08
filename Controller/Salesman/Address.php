<?php 
require_once 'Controller/Core/Action.php';

/**
 * 
 */
class Controller_Salesman_Address extends Controller_Core_Action
{
	public function gridAction()
	{
		require_once 'View/salesman_address/grid.phtml';
	}

	public function editAction()
	{
		require_once 'View/salesman_address/edit.phtml';
	}
	
	public function updateAction()
	{
		$request = $this->getRequest();
		$salesman = $request->getPost('address');
		print_r($salesman);
		$sql = "UPDATE `salesman_address` SET `address` = '$salesman[address]', `city` = '$salesman[city]', `state` = '$salesman[state]', `country` = '$salesman[country]', `zip_code` = '$salesman[zip_code]',`updated_at` = current_timestamp() WHERE `salesman_address`.`salesman_id` = $salesman[salesman_id];";
		$adapter =$this->getAdapter();
		$result = $adapter->update($sql);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=salesman_address&salesman_id=$salesman[salesman_id]");
	}
	
}

?>
<?php 
require_once 'Controller/Core/Action.php';
/**
 * 
 */
class Controller_PaymentMethod extends Controller_Core_Action
{
	public function gridAction()
	{
		require_once 'View/payment_method/grid.phtml';
	}
	public function addAction()
	{
		require_once 'View/payment_method/add.phtml';
	}
	public function editAction()
	{
		require_once 'View/payment_method/edit.phtml';
	}
	public function insertAction()
	{

		$request = $this->getRequest();
		$payment_method = $request->getPost('payment_method');

		$sql = "INSERT INTO `payment_methods` (`payment_method_id`, `name`, `status`, `created_at`, `updated_at`) VALUES ('$payment_method[payment_method_id]', '$payment_method[name]', '$payment_method[status]', current_timestamp(), NULL)";
		$adapter =$this->getAdapter();
		$insert=$adapter->insert($sql);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=paymentmethod");
	}
	public function deleteAction()
	{
		$request = $this->getRequest();
		$sql ="DELETE FROM `payment_methods` WHERE `payment_methods`.`payment_method_id` = {$request->getParam('payment_method_id')}";
		$adapter =$this->getAdapter();
		$delete = $adapter->delete($sql);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=paymentmethod");
	}
	public function updateAction()
	{
		$request = $this->getRequest();
		$payment_method = $request->getPost('payment_method');
		$sql = "UPDATE `payment_methods` SET  `name` = '$payment_method[name]', `status` = '$payment_method[status]', `updated_at` = current_timestamp() WHERE `payment_methods`.`payment_method_id` = $payment_method[payment_method_id];";
		$adapter =$this->getAdapter();
		$update = $adapter->update($sql);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=paymentmethod");
	}
	
}

?>
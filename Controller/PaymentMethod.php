<?php 
require_once 'Controller/Core/Action.php';
/**
 * 
 */
class Controller_PaymentMethod extends Controller_Core_Action
{
	protected $payment_methods = [];

	public function gridAction()
	{
		$sql ="SELECT * FROM `payment_methods` WHERE 1";
		$adapter =$this->getAdapter();
		$payment_methods =$adapter->fetchAll($sql);
		$this->setPaymentMethod($payment_methods);
		$this->getTemplete('payment_method/grid.phtml');
	}
	
	public function addAction()
	{
		$this->getTemplete('payment_method/add.phtml');
	}

	public function editAction()
	{
		$request = $this->getRequest();
		$id=$request->getParam('payment_method_id');
		if(!isset($id))
		{
		throw new Exception("invalid product id.", 1);
		}

		$sql ="SELECT * FROM `payment_methods` WHERE `payment_method_id`= '$id';";
		$adapter =$this->getAdapter();
		$payment_method =$adapter->fetchRow($sql);
		$this->setPaymentMethod($payment_method);
		$this->getTemplete('payment_method/edit.phtml');
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
	

    public function getPaymentMethod()
    {
        return $this->payment_methods;
    }

    public function setPaymentMethod($payment_methods)
    {
        $this->payment_methods = $payment_methods;

        return $this;
    }
}

?>
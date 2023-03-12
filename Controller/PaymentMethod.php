<?php 
require_once 'Controller/Core/Action.php';
require_once 'Model/Payment_method.php';
/**
 * 
 */
class Controller_PaymentMethod extends Controller_Core_Action
{
	protected $payment_methods = [];
	protected $modelPaymentMethod = null;
	public function gridAction()
	{
		$modelPaymentMethod =$this->getModelPaymentMethod();
		$payment_methods =$modelPaymentMethod->fetchAll();
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

		$modelPaymentMethod =$this->getModelPaymentMethod();
		$payment_method =$modelPaymentMethod->fetchRow($id);
		$this->setPaymentMethod($payment_method);
		$this->getTemplete('payment_method/edit.phtml');
	}
	public function insertAction()
	{
		$request = $this->getRequest();
		$payment_method = $request->getPost('payment_method');

		$modelPaymentMethod =$this->getModelPaymentMethod();
		$insert=$modelPaymentMethod->insert($payment_method);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=paymentmethod");
	}
	public function deleteAction()
	{
		$request = $this->getRequest();
		$id = $request->getParam('payment_method_id');
		$modelPaymentMethod =$this->getModelPaymentMethod();
		$delete = $modelPaymentMethod->delete($id);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=paymentmethod");
	}
	public function updateAction()
	{
		$request = $this->getRequest();
		$payment_method = $request->getPost('payment_method');
		$modelPaymentMethod =$this->getModelPaymentMethod();
		$update = $modelPaymentMethod->update($payment_method,$payment_method['payment_method_id']);
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

    public function getModelPaymentMethod()
    {
        if(!$this->modelPaymentMethod)
        {
        	$this->modelPaymentMethod = new Model_PaymentMethod();
        }
        return $this->modelPaymentMethod;
    }

}

?>
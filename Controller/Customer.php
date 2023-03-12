<?php 
require_once 'Controller/Core/Action.php';
require_once 'Model/Customer.php';
require_once 'Model/customer_address.php';
/**
 * 
 */
class Controller_Customer extends Controller_Core_Action
{
	protected $customers = null;
	protected $modelCustomer = null;
	protected $modelCustomerAddress = null;

	public function gridAction()
	{
		$modelCustomer =$this->getModelCustomer();
		$customers =$modelCustomer->fetchall();
		$this->setCustomer($customers);
		$this->getTemplete('customer/grid.phtml');
	}
	public function addAction()
	{
		$this->getTemplete('customer/add.phtml');
	}
	public function editAction()
	{
		$request = $this->getRequest();
		$id=$request->getParam('customer_id');
		if(!isset($id))
		{
		throw new Exception("invalid product id.", 1);
		}
		$modelCustomer =$this->getModelCustomer();
		$customer =$modelCustomer->fetchRow($id);
		$this->setCustomer($customer);
		$this->getTemplete('customer/edit.phtml');
	}
	public function insertAction()
	{
		$request = $this->getRequest();
		$customer = $request->getPost('customer');
		$customerAddress = $request->getPost('customer_address');
		$modelCustomer =$this->getModelCustomer();
		$insert=$modelCustomer->insert($customer);
		if (!$insert) {
			throw new Exception("data not inserted.", 1);
		}
		$customerAddress['customer_id'] = $insert;
		$modelCustomerAddress = $this->getModelCustomerAddress();
		$update = $modelCustomerAddress->insert($customerAddress);
	}
	public function deleteAction()
	{
		$request = $this->getRequest();
		$id = $request->getParam('customer_id');
		$sql ="DELETE FROM `customers` WHERE `customers`.`customer_id` = {$request->getParam('customer_id')}";
		$modelCustomer =$this->getModelCustomer();
		$delete = $modelCustomer->delete($id);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=customer");
	}
	public function updateAction()
	{
		$request = $this->getRequest();
		$customer = $request->getPost('customer');
		$modelCustomer =$this->getModelCustomer();
		$result=$modelCustomer->fetchRow($customer['customer_id']);
		if(!$result){
			throw new Exception("Error Processing Request", 1);
		}
		$update = $modelCustomer->update($customer,$customer['customer_id']);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=customer");
	}
    public function getCustomer()
    {
        return $this->customers;
    }

    public function setCustomer($customers)
    {
        $this->customers = $customers;

        return $this;
    }

    public function getModelCustomer()
    {
        if (!$this->modelCustomer) {
    	$this->modelCustomer = new Model_Customer();
    	}
        return $this->modelCustomer;
    }

    public function getModelCustomerAddress()
    {
        if (!$this->modelCustomerAddress) {
    	$this->modelCustomerAddress = new Model_CustomerAddress();
    	}
        return $this->modelCustomerAddress;
    }
}

?>
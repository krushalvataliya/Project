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
		$id=(int)$request->getParam('customer_id');
		if(!isset($id))
		{
		throw new Exception("invalid product id.", 1);
		}
		$modelCustomer =$this->getModelCustomer();
		$sql = "SELECT * FROM `customers` WHERE `customer_id`= {$id}";
		$customer =$modelCustomer->fetchRow($sql);
		$this->setCustomer($customer);
		$this->getTemplete('customer/edit.phtml');
	}
	public function insertAction()
	{
		$request = $this->getRequest();
		if (!$request->isPost())
		{
			throw new Exception("invalid Request.", 1);
		}
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
		return $this->redirect("http://localhost/project-krushal-vataliya/index.php?a=grid&c=customer");
	}
	public function deleteAction()
	{
		$request = $this->getRequest();
		$id = (int)$request->getParam('customer_id');
		if(!$id)
		{
			throw new Exception("invalid customer ID", 1);
			
		}
		$modelCustomer =$this->getModelCustomer();
		$delete = $modelCustomer->delete($id);
		return $this->redirect("http://localhost/project-krushal-vataliya/index.php?a=grid&c=customer");
	}
	public function updateAction()
	{
		$request = $this->getRequest();
		if (!$request->isPost())
		{
			throw new Exception("invalid Request.", 1);
		}

		$customer = $request->getPost('customer');
		$modelCustomer =$this->getModelCustomer();
		$sql = "SELECT * FROM `customers` WHERE `customer_id`= {$customer['customer_id']}";
		$result=$modelCustomer->fetchRow($sql);
		if(!$result){
			throw new Exception("Error Processing Request", 1);
		}
		
		$update = $modelCustomer->update($customer,$customer['customer_id']);
		return $this->redirect("http://localhost/project-krushal-vataliya/index.php?a=grid&c=customer");
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
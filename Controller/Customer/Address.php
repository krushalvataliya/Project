<?php 
require_once 'Controller/Core/Action.php';
require_once 'Model/customer_address.php';
/**
 * 
 */
class Controller_Customer_Address extends Controller_Core_Action
{
	protected $customerAddress = [];
	protected $modelCustomerAddress = null;

	public function gridAction()
	{
		$request = $this->getRequest();
		$customerId=(int) $request->getParam('customer_id');
		if(!isset($customerId))
		{
		throw new Exception("invalid customer_id.", 1);
		}

		$id['customer_id'] = $customerId;
		$modelCustomerAddress =$this->getModelCustomerAddress();
		$address =$modelCustomerAddress->fetchRow($id);
		$this->setCustomerAddress($address);
		$this->getTemplete('customer_address/grid.phtml');
	}

	public function editAction()
	{
		$request = $this->getRequest();
		$customerId=(int) $request->getParam('customer_id');
		if(!isset($customerId)){
		throw new Exception("invalid customer_id.", 1);
		}
		$modelCustomerAddress =$this->getModelCustomerAddress();
		$id['customer_id'] = $customerId;
		$customerAddress =$modelCustomerAddress->fetchrow($id);
		if (!$customerAddress) {
		throw new Exception("address not found for this customer.", 1);
		}
		$this->setCustomerAddress($customerAddress);
		$this->getTemplete('customer_address/edit.phtml');
	}
	
	public function updateAction()
	{
		$request = $this->getRequest();
		if (!$request->isPost())
		{
			throw new Exception("invalid Request.", 1);
		}
		$customer_address = $request->getPost('address');
		$customer_id['customer_id'] = $customer_address['customer_id'];
		$modelCustomerAddress =$this->getModelCustomerAddress();
		$result=$modelCustomerAddress->fetchRow($customer_id);
		if(!$result){
			throw new Exception("Error Processing Request", 1);
		}
		$id['customer_id'] = $customer_address['customer_id'];
				
		$update = $modelCustomerAddress->update($customer_address, $id);
		return $this->redirect("http://localhost/project-krushal-vataliya/index.php?a=grid&c=customer_address&customer_id=$customer_address[customer_id]");
	}


    public function getCustomerAddress()
    {
        return $this->customerAddress;
    }

    public function setCustomerAddress($customerAddress)
    {
        $this->customerAddress = $customerAddress;

        return $this;
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
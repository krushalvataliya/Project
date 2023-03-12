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
		$customerId=$request->getParam('customer_id');
		$id['customer_id'] = $customerId;
		print_r($id);
		$modelCustomerAddress =$this->getModelCustomerAddress();
		$address =$modelCustomerAddress->fetchRow($id);
		if (!$address) {
		throw new Exception("address not found for this customer.", 1);
		}
		$this->setCustomerAddress($address);
		$this->getTemplete('customer_address/grid.phtml');
	}

	public function editAction()
	{
		$request = $this->getRequest();
		$customerId=$request->getParam('customer_id');
		if(!isset($customerId)){
		throw new Exception("invalid product id.", 1);
		}
		$modelCustomerAddress =$this->getModelCustomerAddress();
		$id['customer_id'] = $customerId;
		$address =$modelCustomerAddress->fetchrow($id);
		if (!$address) {
		throw new Exception("address not found for this customer.", 1);
		}
		$this->setCustomerAddress($address);
		$this->getTemplete('customer_address/edit.phtml');
	}
	
	public function updateAction()
	{
		$request = $this->getRequest();
		$customer_address = $request->getPost('address');
		$sql ="SELECT * FROM `customer_address` WHERE `customer_id`= $customer_address[customer_id]";
		$customer_id['customer_id'] = $customer_address['customer_id'];
		$modelCustomerAddress =$this->getModelCustomerAddress();
		$result=$modelCustomerAddress->fetchRow($customer_id);
		if(!$result){
			throw new Exception("Error Processing Request", 1);
		}
		$id['customer_id'] = $customer_address['customer_id'];
				
		$update = $modelCustomerAddress->update($customer_address, $id);
		print_r($update);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=customer_address&customer_id=$customer_address[customer_id]");
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
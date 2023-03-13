<?php 
require_once 'Controller/Core/Action.php';
require_once 'Model/Vendor_address.php';

class Controller_Vendor_Address extends Controller_Core_Action
{
	protected $vendorAddress = [];
	protected $modelVendorAddress = null;

	public function gridAction()
	{
		$request = $this->getRequest();
		$id['vendor_id']=$request->getParam('vendor_id');
		$modelVendorAddress =$this->getModelVendorAddress();
		$address =$modelVendorAddress->fetchrow($id);
		if (!$address) {
		throw new Exception("address not found for this vendor.", 1);
		}
		$this->setVendorAddress($address);
		$this->getTemplete('vendor_address/grid.phtml');
	}

	public function editAction()
	{
		$request = $this->getRequest();
		$id['vendor_id']=$request->getParam('vendor_id');
		if(!isset($id))
		{
		  throw new Exception("invalid vendor_id.", 1);
		}
		$modelVendorAddress =$this->getModelVendorAddress();
		$address =$modelVendorAddress->fetchrow($id);
		if (!$address) {
		throw new Exception("address not found for this vendor.", 1);
		}
		$this->setVendorAddress($address);
		$this->getTemplete('vendor_address/edit.phtml');
	}
	
	public function updateAction()
	{
		$request = $this->getRequest();
		$vendor_address = $request->getPost('address');
		$id['vendor_id']= $vendor_address['vendor_id'];
		$modelVendorAddress =$this->getModelVendorAddress();
		$result=$modelVendorAddress->fetchRow($id);
		if(!$result){
			throw new Exception("Error Processing Request", 1);
		}
		$update = $modelVendorAddress->update($vendor_address, $id);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=vendor_address&vendor_id=$vendor_address[vendor_id]");
	}


    public function getVendorAddress()
    {
        return $this->vendorAddress;
    }

    public function setVendorAddress($vendorAddress)
    {
        $this->vendorAddress = $vendorAddress;

        return $this;
    }
    public function getModelVendorAddress()
    {
    	if(!$this->modelVendorAddress)
        {
        	$this->modelVendorAddress = new Model_VendorAddress();
        }
        return $this->modelVendorAddress;
    }
}

?>
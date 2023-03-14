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
		$id=(int)$request->getParam('vendor_id');
		if(!$id)
		{
			throw new Exception("invalid vendor ID.", 1);
			
		}
		$modelVendorAddress =$this->getModelVendorAddress();
		$sql = "SELECT * FROM `vendor_address` WHERE `vendor_id`= {$id}";
		$address =$modelVendorAddress->fetchRow($sql);
		if (!$address) {
		throw new Exception("address not found for this vendor.", 1);
		}
		$this->setVendorAddress($address);
		$this->getTemplete('vendor_address/grid.phtml');
	}

	public function editAction()
	{
		$request = $this->getRequest();
		$id=(int)$request->getParam('vendor_id');
		if(!$id)
		{
		  throw new Exception("invalid vendor ID.", 1);
		}
		$modelVendorAddress =$this->getModelVendorAddress();
		$sql = "SELECT * FROM `vendor_address` WHERE `vendor_id`= {$id}";
		$address =$modelVendorAddress->fetchrow($sql);
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
		$sql = "SELECT * FROM `vendor_address` WHERE `vendor_id`= {$id['vendor_id']}";
		$result=$modelVendorAddress->fetchRow($sql);
		if(!$result){
			throw new Exception("data not found.", 1);
		}
		$update = $modelVendorAddress->update($vendor_address, $id);
		return $this->redirect("http://localhost/project-krushal-vataliya/index.php?a=grid&c=vendor_address&vendor_id=$vendor_address[vendor_id]");
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
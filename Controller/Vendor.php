<?php 
require_once 'Controller/Core/Action.php';
require_once 'Model/Vendor.php';
require_once 'Model/Vendor_address.php';

/**
 * 
 */
class Controller_Vendor extends Controller_Core_Action
{
	protected $vendors = [];
	protected $modelVendor = null;
	protected $modelVendorAddress = null;
	public function gridAction()
	{	
		$sql ="SELECT * FROM `vendors` WHERE 1";
		$modelVendor =$this->getModelVendor();
		$vendors =$modelVendor->fetchAll();
		$this->setVendor($vendors);
		$this->getTemplete('vendor/grid.phtml');
	}
	public function addAction()
	{
		$this->getTemplete('vendor/add.phtml');
	}
	public function editAction()
	{
		$request = $this->getRequest();
		$id=$request->getParam('vendor_id');
		if(!isset($id))
		{
		  throw new Exception("invalid product id.", 1);
		}
		$modelVendor =$this->getModelVendor();
		$vendor =$modelVendor->fetchRow($id);
		$this->setVendor($vendor);
		$this->getTemplete('vendor/edit.phtml');
	}
	public function insertAction()
	{
		$request = $this->getRequest();
		$vendor = $request->getPost('vendor');
		$vendorAddress = $request->getPost('vendor_address');
		$modelVendor =$this->getModelVendor();
		$insert=$modelVendor->insert($vendor);
		if (!$insert) {
			throw new Exception("Error Processing Request", 1);
		}
		$vendorAddress['vendor_id'] = $insert;
		$modelVendorAddress =$this->getModelVendorAddress();
		$insert=$modelVendorAddress->insert($vendorAddress);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=vendor");
	}
	public function deleteAction()
	{
		$request = $this->getRequest();
		$modelVendor =$this->getModelVendor();
		$id = $request->getParam('vendor_id');
		$delete = $modelVendor->delete($id);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=vendor");
	}
	public function updateAction()
	{
		$request = $this->getRequest();
		$vendor = $request->getPost('vendor');
			$sql ="UPDATE `vendors` SET `first_name` = '$vendor[first_name]', `last_name` = '$vendor[last_name]', `email` = '$vendor[email]', `gender` = '$vendor[gender]', `mobile` = '$vendor[mobile]', `status` = '$vendor[status]', `company` = '$vendor[company]',`updated_at` = current_timestamp() WHERE `vendors`.`vendor_id` = $vendor[vendor_id];";
		$modelVendor =$this->getModelVendor();
		 $update = $modelVendor->update($vendor, $vendor['vendor_id']);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=vendor");
	}
	
    public function getVendor()
    {
        return $this->vendors;
    }

    public function setVendor($vendors)
    {
        $this->vendors = $vendors;

        return $this;
    }

   

   
    public function getModelVendor()
    {
        if(!$this->modelVendor)
        {
        	$this->modelVendor = new Model_Vendor();
        }
        return $this->modelVendor;
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
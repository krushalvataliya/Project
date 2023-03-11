<?php 
require_once 'Controller/Core/Action.php';

/**
 * 
 */
class Controller_ShippingMethod extends Controller_Core_Action
{
	protected $shipping_methods = null;

	public function gridAction()
	{
		$sql ="SELECT * FROM `shiping_methods` WHERE 1";
		$adapter =$this->getAdapter();
		$shipping_methods =$adapter->fetchAll($sql);
		$this->setShippingMethod($shipping_methods);
		$this->getTemplete('shipping_method/grid.phtml');
	}
	public function addAction()
	{
		$this->getTemplete('shipping_method/add.phtml');
	}
	public function editAction()
	{
		$request = $this->getRequest();
		$id=$request->getParam('shiping_method_id');
		if(!isset($id))
		{
		  throw new Exception("invalid product id.", 1);
		}
		$sql ="SELECT * FROM `shiping_methods` WHERE `shiping_method_id`= '$id';";
		$adapter =$this->getAdapter();
		$shiping_method =$adapter->fetchRow($sql);
		$this->setShippingMethod($shiping_method);
		$this->getTemplete('shipping_method/edit.phtml');
	}
	public function insertAction()
	{
		$request = $this->getRequest();
		$shiping_method = $request->getPost('shipping_method');
		$sql = "INSERT INTO `shiping_methods` (`shiping_method_id`, `name`, `amount`, `status`, `created_at`, `updated_at`) 
				VALUES ('$shiping_method[shiping_method_id]', '$shiping_method[name]', '$shiping_method[amount]', '$shiping_method[status]', current_timestamp(), NULL);";
		$adapter =$this->getAdapter();
		$insert=$adapter->insert($sql);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=shippingmethod");

	}
	public function deleteAction()
	{
		$request = $this->getRequest();
		$sql ="DELETE FROM `shiping_methods` WHERE `shiping_methods`.`shiping_method_id` = {$request->getParam('shiping_method_id')}";
		$adapter =$this->getAdapter();
		$delete = $adapter->delete($sql);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=shippingmethod");
	}
	public function updateAction()
	{
		$request = $this->getRequest();
		$shiping_method = $request->getPost('shiping_method');
		print_r($shiping_method);
		$sql = "UPDATE `shiping_methods` SET  `name` = '$shiping_method[name]', `amount` = '$shiping_method[amount]', `status` =  '$shiping_method[status]', `updated_at` = current_timestamp() WHERE `shiping_methods`.`shiping_method_id` =  $shiping_method[shiping_method_id];";
		$adapter =$this->getAdapter();
		$update = $adapter->update($sql);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=shippingmethod");
	}
	

    /**
     * @return mixed
     */
    public function getShippingMethod()
    {
        return $this->shipping_methods;
    }

    /**
     * @param mixed $shipping_methods
     *
     * @return self
     */
    public function setShippingMethod($shipping_methods)
    {
        $this->shipping_methods = $shipping_methods;

        return $this;
    }
}

?>
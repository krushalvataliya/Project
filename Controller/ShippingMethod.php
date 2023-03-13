<?php 
require_once 'Controller/Core/Action.php';
require_once 'Model/Shipping_method.php';

/**
 * 
 */
class Controller_ShippingMethod extends Controller_Core_Action
{
	protected $shipping_methods = [];
	protected $modelShippingMethod = null;

	public function gridAction()
	{	
		$modelShippingMethod =$this->getModelShippingMethod();
		$shipping_methods =$modelShippingMethod->fetchAll();
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
		$id=(int)$request->getParam('shiping_method_id');
		if(!isset($id))
		{
		  throw new Exception("invalid product id.", 1);
		}
		$modelShippingMethod =$this->getModelShippingMethod();
		$shiping_method =$modelShippingMethod->fetchRow($id);
		$this->setShippingMethod($shiping_method);
		$this->getTemplete('shipping_method/edit.phtml');
	}
	public function insertAction()
	{
		$request = $this->getRequest();
		if (!$request->isPost())
		{
			throw new Exception("invalid Request.", 1);
		}

		$shiping_method = $request->getPost('shipping_method');
		$modelShippingMethod =$this->getModelShippingMethod();
		$insert=$modelShippingMethod->insert($shiping_method);
		return $this->redirect("http://localhost/project-krushal-vataliya/index.php?a=grid&c=shippingmethod");

	}
	public function deleteAction()
	{
		$request = $this->getRequest();
		$id =(int) $request->getParam('shiping_method_id');
		if(!$id)
		{
			throw new Exception("invalid shiping method ID", 1);
		}
			
		$modelShippingMethod =$this->getModelShippingMethod();
		$delete = $modelShippingMethod->delete($id);
		return $this->redirect("http://localhost/project-krushal-vataliya/index.php?a=grid&c=shippingmethod");
	}
	public function updateAction()
	{
		$request = $this->getRequest();
		if (!$request->isPost())
		{
			throw new Exception("invalid Request.", 1);
		}
		$shiping_method = $request->getPost('shiping_method');
		$modelShippingMethod =$this->getModelShippingMethod();
		$update = $modelShippingMethod->update($shiping_method, $shiping_method['shiping_method_id']);
		return $this->redirect("http://localhost/project-krushal-vataliya/index.php?a=grid&c=shippingmethod");
	}
	

    public function getShippingMethod()
    {
        return $this->shipping_methods;
    }

    public function setShippingMethod($shipping_methods)
    {
        $this->shipping_methods = $shipping_methods;

        return $this;
    }

    public function getModelShippingMethod()
    {
        if(!$this->modelShippingMethod)
        {
        	$this->modelShippingMethod = new Model_ShippingMethod();
        }
        return $this->modelShippingMethod;
    }

}

?>
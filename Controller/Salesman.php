<?php 
require_once 'Controller/Core/Action.php';
require_once 'Model/salesman.php';
require_once 'Model/salesman_address.php';
/**
 * 
 */
class Controller_Salesman extends Controller_Core_Action
{
	protected $salesmen = null;
	protected $modelSalesman = null;
	protected $modelSalesmanAddress = null;

	public function gridAction()
	{
		$modelSalesman =$this->getModelSalesman();
		$salesmen =$modelSalesman->fetchAll();
		$this->setSalesmen($salesmen);
		$this->getTemplete('salesman/grid.phtml');
	}
	public function addAction()
	{
		$this->getTemplete('salesman/add.phtml');
	}
	public function editAction()
	{
		$request = $this->getRequest();
		$id=$request->getParam('salesman_id');
		if(!isset($id))
		{
		throw new Exception("invalid product id.", 1);
		}
		$modelSalesman =$this->getModelSalesman();
		$salesman =$modelSalesman->fetchRow($id);
		$this->setSalesmen($salesman);
		$this->getTemplete('salesman/edit.phtml');
	}
	public function insertAction()
	{
		$request = $this->getRequest();
		$salesman = $request->getPost('salesman');
		$address = $request->getPost('salesman_address');
		$modelSalesman =$this->getModelSalesman();
		$insert = $modelSalesman->insert($salesman);
		if (!$insert) {
			throw new Exception("Error Processing Request", 1);
		}
		$address['salesman_id'] = $insert; 
		$modelSalesmanAddress = $this->getModelSalesmanAddress();
		$insert2=$modelSalesmanAddress->insert($address);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=salesman");

	}
	public function deleteAction()
	{
		$request = $this->getRequest();		
		$id = $request->getParam('salesman_id');	
		$modelSalesman =$this->getModelSalesman();
		$delete = $modelSalesman->delete($id);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=salesman");
	}
	public function updateAction()
	{
		$request = $this->getRequest();
		$salesman = $request->getPost('salesman');
 			$modelSalesman =$this->getModelSalesman();
		$update = $modelSalesman->update($salesman, $salesman['salesman_id']);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=salesman");
	}
	
    public function getSalesmen()
    {
        return $this->salesmen;
    }

    public function setSalesmen($salesmen)
    {
        $this->salesmen = $salesmen;

        return $this;
    }

    public function getModelSalesman()
    {
        if(!$this->modelSalesman)
        {
        	$this->modelSalesman = new Model_Salesman();
        }
        return $this->modelSalesman;
    }

    public function getModelSalesmanAddress()
    {
        if(!$this->modelSalesmanAddress)
        {
        	$this->modelSalesmanAddress = new Model_SalesmanAddress();
        }
        return $this->modelSalesmanAddress;
    }
}

?>
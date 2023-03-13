<?php 
require_once 'Controller/Core/Action.php';
require_once 'Model/salesman_address.php';

/**
 * 
 */
class Controller_Salesman_Address extends Controller_Core_Action
{
	protected $salesmanAddress = [];
	protected $modelSalesmanAddress = null;

	public function gridAction()
	{
		$request = $this->getRequest();
		$id['salesman_id']=$request->getParam('salesman_id');
		$modelSalesmanAddress =$this->getModelSalesmanAddress();
		$address =$modelSalesmanAddress->fetchrow($id);
		if (!$address) {
		throw new Exception("address not found for this salesman.", 1);
		}
		$this->setSalesmanAddress($address);
		$this->getTemplete('salesman_address/grid.phtml');
	}

	public function editAction()
	{
		$request = $this->getRequest();
		$id['salesman_id']=$request->getParam('salesman_id');
		if(!isset($id))
		{
		  throw new Exception("invalid salesman_id.", 1);
		}

		$modelSalesmanAddress =$this->getModelSalesmanAddress();
		$address =$modelSalesmanAddress->fetchrow($id);
		if (!$address) {
		throw new Exception("address not found for this salesman.", 1);
		}
		$this->setSalesmanAddress($address);
		$this->getTemplete('salesman_address/edit.phtml');
	}
	
	public function updateAction()
	{
		$request = $this->getRequest();
		$salesman = $request->getPost('address');
		$id['salesman_id'] = $salesman['salesman_id'];
		$modelSalesmanAddress =$this->getModelSalesmanAddress();
		$result = $modelSalesmanAddress->update($salesman, $id);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=salesman_address&salesman_id=$salesman[salesman_id]");
	}
	

    public function getSalesmanAddress()
    {
        return $this->salesmanAddress;
    }

    public function setSalesmanAddress($salesmanAddress)
    {
        $this->salesmanAddress = $salesmanAddress;

        return $this;
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
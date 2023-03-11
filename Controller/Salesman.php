<?php 
require_once 'Controller/Core/Action.php';
/**
 * 
 */
class Controller_Salesman extends Controller_Core_Action
{
	protected $salesmen = null;

	public function gridAction()
	{
		$sql ="SELECT * FROM `salesmans` WHERE 1";
		$adapter =$this->getAdapter();
		$salesmen =$adapter->fetchAll($sql);
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
		$sql ="SELECT * FROM `salesmans` WHERE `salesman_id`= '$id';";
		$adapter =$this->getAdapter();
		$salesman =$adapter->fetchRow($sql);
		$this->setSalesmen($salesman);
		$this->getTemplete('salesman/edit.phtml');
	}
	public function insertAction()
	{
		$request = $this->getRequest();
		$salesman = $request->getPost('salesman');
		$address = $request->getPost('salesman_address');
		
		$sql ="INSERT INTO `salesmans` (`salesman_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `company`, `created_at`, `updated_at`)VALUES ('$salesman[salesman_id]', '$salesman[first_name]', '$salesman[last_name]', '$salesman[email]', '$salesman[gender]', '$salesman[mobile]', '$salesman[status]', '$salesman[company]', current_timestamp(), NULL);";
		$adapter =$this->getAdapter();
		$insert = $adapter->insert($sql);
		if (!$insert) {
			throw new Exception("Error Processing Request", 1);
		}
		$sql2 = "INSERT INTO `salesman_address` (`address`, `city`, `state`, `country`, `zip_code`, `created_at`, `updated_at`, `salesman_id`)
		 			VALUES ('$address[address]', '$address[city]', '$address[state]', '$address[country]', '$address[zip_code]', current_timestamp(), NULL, '$insert');";

		$insert2=$adapter->insert($sql2);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=salesman");

	}
	public function deleteAction()
	{
		$request = $this->getRequest();		
		$id = $request->getParam('salesman_id');	
		$sql ="DELETE FROM `salesmans` WHERE `salesmans`.`salesman_id` = {$id}";
		$adapter =$this->getAdapter();
		$delete = $adapter->delete($sql);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=salesman");
	}
	public function updateAction()
	{
		$request = $this->getRequest();
		$salesman = $request->getPost('salesman');
		$sql ="UPDATE `salesmans` SET `first_name`='$salesman[first_name]',`last_name`='$salesman[last_name]',`email`='$salesman[email]',`gender`='$salesman[gender]',`mobile`='$salesman[mobile]',`status`='$salesman[status]',`company`='$salesman[company]',`updated_at` = current_timestamp() WHERE `salesmans`.`salesman_id` = $salesman[salesman_id] ; ";
		$adapter =$this->getAdapter();
		$update = $adapter->update($sql);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=salesman");
	}
	

    /**
     * @return mixed
     */
    public function getSalesmen()
    {
        return $this->salesmen;
    }

    /**
     * @param mixed $salesmen
     *
     * @return self
     */
    public function setSalesmen($salesmen)
    {
        $this->salesmen = $salesmen;

        return $this;
    }
}

?>
<?php 
require_once 'Controller/Core/Action.php';
/**
 * 
 */
class Controller_Salesman_price extends Controller_Core_Action
{
	public function gridAction()
	{
		$this->getTemplete('Salesman_price/grid.phtml');
	}

	public function updateAction()
	{
		$request = $this->getRequest();
		$update_sprice = $request->getPost('sprice');
		$id =$request->getParam('salesman_id');
		$adapter =$this->getAdapter();
		$update = $request->getPost('update');
		if($update = 'update'){
		foreach ($update_sprice as $key => $value) {
		$search_query = 'SELECT `entity_id` FROM `salesman_price` WHERE `product_id` = '.$key.' AND `salesman_id` = '.$id.'';
		$result = $adapter->fetchAll($search_query);
		if ($result) {
		$updateQuery = 'UPDATE `salesman_price` SET `salesman_price` = '.$value.' WHERE `product_id` = '.$key.' AND `salesman_id` = '.$id.'';
		$result = $adapter->update($updateQuery);
		}else{
		$insert = 'INSERT INTO `salesman_price`(`product_id`, `salesman_id`, `salesman_price`) VALUES ('.$key.','.$id.','.$value.')';
		$result = $adapter->update($insert);
		}
		}
		}
		$delete = $request->getPost('delete');

		if ($delete = 'delete') {
			$request = $this->getRequest();
		$delete = $request->getPost('delete_price');
		foreach ($delete as $key => $value) {
		$delete = "DELETE FROM salesman_price WHERE `salesman_price`.`entity_id` =$key";
		// $update = 'UPDATE `salesman_price` SET `salesman_price` = '.$value.' WHERE `product_id` = '.$key.'';
		$result = $adapter->update($delete);
		print_r($result);
		}
		}
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=salesman_price&salesman_id={$id}");
	}

}

?>
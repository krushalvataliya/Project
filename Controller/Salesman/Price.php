<?php 
require_once 'Controller/Core/Action.php';
require_once 'Model/Salesman_price.php';
/**
 * 
 */
class Controller_Salesman_price extends Controller_Core_Action
{
	protected $salesmen_price = [];
	protected $salesmen = [];
	protected $modelSalesmanPrice = null;

	public function gridAction()
	{
		$request = $this->getRequest();
		$id=$request->getParam('salesman_id');
		$sql="SELECT * FROM `salesmen` ORDER BY `first_name` ASC";
		$modelSalesmanPrice =$this->getModelSalesmanPrice();
		$salesmen = $modelSalesmanPrice->fetchAll($sql);
		$this->setSalesmen($salesmen);
		$sql = "SELECT SP.entity_id, SP.salesman_price, P.sku, P.cost, P.price, P.product_id 
		FROM `products` P 
		LEFT JOIN `salesman_price` SP ON P.product_id = SP.product_id AND SP.salesman_id = ".$id."";
		$products = $modelSalesmanPrice->fetchAll($sql);
		$this->setSalesmenPrice($products);
		$this->getTemplete('Salesman_price/grid.phtml');
	}

	public function updateAction()
	{
		$request = $this->getRequest();
		$update_sprice = $request->getPost('sprice');
		$id =$request->getParam('salesman_id');
		$modelSalesmanPrice =$this->getModelSalesmanPrice();
		$update = $request->getPost('update');
		if($update = 'update'){
		foreach ($update_sprice as $key => $value) {
		$search_query = 'SELECT `entity_id` FROM `salesman_price` WHERE `product_id` = '.$key.' AND `salesman_id` = '.$id.'';
		$result = $modelSalesmanPrice->fetchAll($search_query);
		if ($result) {
			$salesmanPrice['salesman_price'] = $value;
			$condition = array('product_id' => $key, 'salesman_id' => $id);
		// $updateQuery = 'UPDATE `salesman_price` SET `salesman_price` = '.$value.' WHERE `product_id` = '.$key.' AND `salesman_id` = '.$id.'';
		$result = $modelSalesmanPrice->update($salesmanPrice, $condition);
		}else{
		if($value != null)
		{
		$salesmanPrice = array('product_id' => $key, 'salesman_id' => $id, 'salesman_price' => $value);
		// $insert = 'INSERT INTO `salesman_price`(`product_id`, `salesman_id`, `salesman_price`) VALUES ('.$key.','.$id.','.$value.')';
		$result = $modelSalesmanPrice->insert($salesmanPrice);
		}
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
		$result = $modelSalesmanPrice->delete($key);
		print_r($result);
		}
		}
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=salesman_price&salesman_id={$id}");
	}

    public function getSalesmenPrice()
    {
        return $this->salesmen_price;
    }

    public function setSalesmenPrice($salesmen_price)
    {
        $this->salesmen_price = $salesmen_price;

        return $this;
    }

    public function getModelSalesmanPrice()
    {
        if(!$this->modelSalesmanPrice)
        {
        $this->modelSalesmanPrice = new Model_SalesmanPrice();
        }
        return $this->modelSalesmanPrice;
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
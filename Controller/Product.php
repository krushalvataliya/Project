<?php 
require_once 'Controller/Core/Action.php';
require_once 'Model/Product.php';

/**
 * 
 */
class Controller_Product extends Controller_Core_Action
{
	protected $products = [];

	public function getProduct()
	{
		return $this->products;
	}

    protected function setProduct($products)
	{
		$this->products = $products;
		return $this;
	}
	public function gridAction()
	{		
		$modelProduct = new Model_Product();
		$products =$modelProduct->fetchAll();
		if(!$products)
		{
			throw new Exception("no data available.", 1);
		}
		
		$this->setProduct($products);
		require_once "View/product/grid.phtml";
		// $this->getTemplete('product/grid.phtml');
	}
	public function addAction()
	{
		$this->getTemplete('product/add.phtml');
	}

	public function editAction()
	{
		$request = $this->getRequest();
		$id=$request->getParam('product_id');
		if(!isset($id))
		{
		throw new Exception("invalid product id.", 1);
		}
		$modelProduct = new Model_Product();
		$product =$modelProduct->fetchRow($id);
		$this->setProduct($product);
		$this->getTemplete('product/edit.phtml');
	}

	public function insertAction()
	{
		$request = $this->getRequest();
		if (!$request->isPost()) {
			throw new Exception("invalid Request.", 1);
		}

		$product = $request->getPost('product');
		if(!$product)
		{
			throw new Exception("no data posted.", 1);
		}

		$modelProduct = new Model_Product();
		$products =$modelProduct->insert($product);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=product");
	}

	public function deleteAction()
	{
		$request = $this->getRequest();
		if (!$request->isGet()) {
			throw new Exception("invalid Request.", 1);
		}

		$id = $request->getParam('product_id');
		$modelProduct = new Model_Product();
		$products =$modelProduct->delete($id);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=product");
	}

	public function updateAction()
	{
		$request = $this->getRequest();
		if (!$request->isPost()) {
			throw new Exception("invalid Request.", 1);
		}

		$product = $request->getPost('product');
		if(!$product)
		{
			throw new Exception("no data posted.", 1);
		}

		$modelProduct = new Model_Product();
		$products =$modelProduct->update($product,$product['product_id']);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=product");
	}

}

?>
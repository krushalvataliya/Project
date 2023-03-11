<?php
require_once 'Model/Core/Adapter.php';
require_once 'Model/Core/Request.php';
/**
*
*/
class Controller_Core_Action
{
	public $request = null;
	public $adapter = null;

	public function getRequest()
	{
		if($this->request)
		{
			return $this->request;
		}
		$request = new Model_Core_Request();
		$this->setRequest($request);
		return $request;
	}

    protected function setRequest(Model_Core_Request $request)
	{
		$this->request = $request;
		return $this;
	}

	public function getAdapter()
	{
		if($this->adapter)
		{
			return $this->adapter;
		}
		$adapter = new Model_Core_Adapter();
		$this->setAdapter($adapter);
		return $adapter;
	}

    protected function setAdapter(Model_Core_Adapter  $adapter)
	{
		$this->adapter = $adapter;
		return $this;
	}

	public function errorAction($action)
	{
		throw new Exception("method:{$action} does not exists.", 1);
		
	}

	public function redirect($url)
	{
		if($url == null){
			$url = "http://localhost/new_project/index.php?a=grid&c=product";
		}
		header("location: {$url}");
		exit();
	}

	public function getTemplete($templetePath)
	{
		require_once "View".DS.$templetePath;
	}
}
?>
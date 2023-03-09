<?php
require_once 'Controller/Core/Action.php';
/**
 * 
 */
class Controller_Core_Front extends Controller_Core_Action 
{
	
	public function init()
	{
		$request = $this->getRequest();
		$controllerName =$request->getControllerName();
		$controllerClassName ='Controller_'.ucwords($controllerName, '_');
		$controllerClassPath = str_replace('_', '/', $controllerName);
		require_once 'Controller/'.$controllerClassPath.'.php';
		$action = $request->getActionName().'Action';
		$Controller = new $controllerClassName();
		if(!method_exists($Controller, $action))
		{
			$Controller->errorAction($action);
		}
		
		$Controller->$action();
	}

}
?>
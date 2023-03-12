<?php
require_once 'Controller/Core/Action.php';
require_once 'Model/Cetegory.php';
/**
*
*/
class Controller_Category extends Controller_Core_Action
{
	protected $category = [];
	protected $editCategory = [];
	protected $modelCetegory = null;
	public function gridAction()
	{
		$modelCetegory = $this->getModelCetegory();
		$sql = "SELECT * FROM `categories` ORDER BY `categories`.`parent_id` ASC";
		$categories = $modelCetegory->fetchAll($sql);
		$this->setCategory($categories);
		$this->getTemplete('category/grid.phtml');
	}
	public function addAction()
	{
		$modelCetegory = $this->getModelCetegory();
		$categories = $modelCetegory->fetchAll();
		$this->setCategory($categories);
		$this->getTemplete('category/add.phtml');
	}
	public function editAction()
	{
		$request = $this->getRequest();
		$id=$request->getParam('category_id');
		if(!isset($id))
		{
		throw new Exception("invalid product id.", 1);
		}

		$modelCetegory =$this->getModelCetegory();
		$categories = $modelCetegory->fetchAll();
		$this->setCategory($categories);
		$category =$modelCetegory->fetchRow($id);
		$this->setEditCategory($category);
		$this->getTemplete('category/edit.phtml');
	}
	public function insertAction()
	{
		$request = $this->getRequest();
		$category = $request->getPost('category');
		print_r($category);	
		if($category["parent_id"] == 'null')
		{
			unset($category["parent_id"]);
		}

		$modelCetegory = $this->getModelCetegory();
		$insert=$modelCetegory->insert($category);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=category");
	}
	public function deleteAction()
	{
		$request = $this->getRequest();
		$id = $request->getParam('category_id');
		$modelCetegory = $this->getModelCetegory();
		$delete = $modelCetegory->delete($id);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=category");
	}
	public function updateAction()		
	{
		$request = $this->getRequest();
		$category = $request->getPost('category');
		$modelCetegory = $this->getModelCetegory();	
		$categoryResult =$modelCetegory->fetchRow($category['category_id']);
		if(!$categoryResult)
		{
		throw new Exception("Error Processing Request", 1);
		}

		$update = $modelCetegory->update($category, $category['category_id']);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=category");
	}
	
    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    
    public function getEditCategory()
    {
        return $this->editCategory;
    }

    public function setEditCategory($editCategory)
    {
        $this->editCategory = $editCategory;

        return $this;
    }

    public function getModelCetegory()
    {
    	if (!$this->modelCetegory) {
    	$this->modelCetegory = new Model_Cetegory();
    	}
        return $this->modelCetegory;
    }
}

?>
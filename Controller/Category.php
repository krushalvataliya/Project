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
		if(!$categories)
		{
			throw new Exception("data not found.", 1);
		}

		$this->setCategory($categories);
		$this->getTemplete('category/add.phtml');
	}
	public function editAction()
	{
		$request = $this->getRequest();
		$id=(int)$request->getParam('category_id');
		if(!isset($id))
		{
		throw new Exception("invalid product id.", 1);
		}

		$modelCetegory =$this->getModelCetegory();
		$categories = $modelCetegory->fetchAll();
		if(!$categories)
		{
			throw new Exception("data not found.", 1);
		}
		$this->setCategory($categories);
		$sql = "SELECT * FROM `categories` WHERE `category_id`= {$id}";
		$category =$modelCetegory->fetchRow($sql);
		if(!$category)
		{
			throw new Exception("data not found.", 1);
		}
		$this->setEditCategory($category);
		$this->getTemplete('category/edit.phtml');
	}
	public function insertAction()
	{
		$request = $this->getRequest();
		if (!$request->isPost())
		{
			throw new Exception("invalid Request.", 1);
		}

		$category = $request->getPost('category');
		print_r($category);	
		if($category["parent_id"] == 'null')
		{
			unset($category["parent_id"]);
		}

		$modelCetegory = $this->getModelCetegory();
		$insert=$modelCetegory->insert($category);
		return $this->redirect("http://localhost/project-krushal-vataliya/index.php?a=grid&c=category");
	}
	public function deleteAction()
	{
		$request = $this->getRequest();
		$id =(int)$request->getParam('category_id');
		if(!$id)
		{
			throw new Exception("invalid category ID.", 1);
		}
		
		$modelCetegory = $this->getModelCetegory();
		$delete = $modelCetegory->delete($id);
		return $this->redirect("http://localhost/project-krushal-vataliya/index.php?a=grid&c=category");
	}

	public function updateAction()		
	{
		$request = $this->getRequest();
		$category = $request->getPost('category');
		$modelCetegory = $this->getModelCetegory();
		$sql = "SELECT * FROM `categories` WHERE `category_id`= {$category['category_id']}";	
		$categoryResult =$modelCetegory->fetchRow($sql);
		if(!$categoryResult)
		{
		throw new Exception("Error Processing Request", 1);
		}

		$update = $modelCetegory->update($category, $category['category_id']);
		return $this->redirect("http://localhost/project-krushal-vataliya/index.php?a=grid&c=category");
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
<?php
require_once 'Controller/Core/Action.php';
/**
*
*/
class Controller_Category extends Controller_Core_Action
{
	protected $category = [];
	protected $editCategory = [];

	public function gridAction()
	{
		$sql ="SELECT * FROM `categories` ORDER BY `parent_id` ASC;";
		$adapter =$this->getAdapter();
		$categories =$adapter->fetchAll($sql);
		$this->setCategory($categories);
		$this->getTemplete('category/grid.phtml');
	}
	public function addAction()
	{
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
		$sql ="SELECT * FROM `categories` WHERE `category_id`= '$id';";
		$adapter =$this->getAdapter();
		$category =$adapter->fetchRow($sql);
		$this->setEditCategory($category);
		$this->getTemplete('category/edit.phtml');
	}
	public function insertAction()
	{
		$request = $this->getRequest();
		$category = $request->getPost('category');
		if($category['sub_category'] == 0){
		$sql = "INSERT INTO `categories` (`parent_id` ,`name`, `status`, `description`, `created_at`, `updated_at`)
				VALUES (NULL, '$category[name]', '$category[status]', '$category[description]', current_timestamp(), NULL);";}
				else{$sql = "INSERT INTO `categories` (`parent_id` ,`name`, `status`, `description`, `created_at`, `updated_at`)
				VALUES ('$category[sub_category]', '$category[name]', '$category[status]', '$category[description]', current_timestamp(), NULL);";}
		$adapter =$this->getAdapter();
			$insert=$adapter->insert($sql);
		var_dump($insert);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=category");
	}
	public function deleteAction()
	{
		$request = $this->getRequest();
		$sql ="DELETE FROM `categories` WHERE `categories`.`category_id` = {$request->getParam('category_id')}";
		$adapter =$this->getAdapter();
		$delete = $adapter->delete($sql);
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=category");
	}
	public function updateAction()		
	{
		$request = $this->getRequest();
		$category = $request->getPost('category');
		$sql ="SELECT * FROM `categories` WHERE `category_id`= '$category[category_id]';";
		$adapter =$this->getAdapter();
			$categoryr =$adapter->fetchRow($sql);
		if(!$categoryr){
		throw new Exception("Error Processing Request", 1);
		}
		if($category['sub_category'] == 0){
		$sql ="UPDATE `categories` SET `name` = '$category[name]', `status` = '$category[status]', `description` = '$category[description]' ,`updated_at` = current_timestamp()
				WHERE `categories`.`category_id` = $category[category_id]";}
		else{
			$sql ="UPDATE `categories` SET `name` = '$category[name]', `parent_id` = '$category[sub_category]',`status` = '$category[status]', `description` = '$category[description]' ,`updated_at` = current_timestamp()
				WHERE `categories`.`category_id` = $category[category_id]";}
		$update = $adapter->update($sql);
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
}

?>
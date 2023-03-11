<?php 
require_once 'Controller/Core/Action.php';
/**
 * 
 */
class Controller_Product_Media extends Controller_Core_Action
{
	function gridAction()
	{
		$this->getTemplete('product_media/grid.phtml');
	}
	function addAction()
	{
		$this->getTemplete('product_media/add.phtml');
	}
	function insertAction()
	{
		$request = $this->getRequest();
		$productId = $request->getParam('product_id');
		$target_dir = "view/product_media/media/";
		$file = basename($_FILES["fileToUpload"]["name"]);
		$fileArray = explode('.', $file);
		$sql = "INSERT INTO `image` (`img`,`filename`,`product_id`) VALUES ('hh','$_POST[filename]','$_POST[product_id]') ";
		$adapter =$this->getAdapter();
		$insert=$adapter->insert($sql);
		$targetName=$insert.'i.'.$fileArray[1];
		$target_file = $target_dir .$targetName;
		echo $target_file;
		print_r($target_file);
		var_dump(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file));
		$sql = "UPDATE `image` SET `img`='$targetName' WHERE  `img_id`= '{$insert}'";
		$update = $adapter->update($sql);
	return $this->redirect("http://localhost/new_project/index.php?a=grid&c=product_media&product_id={$productId}");

	}
	function updateAction()
	{
		$request = $this->getRequest();
		$button = $request->getPost('button');
		if($button == 'delete'){
			return $this->deleteAction();
			}
		$request = $this->getRequest();
		$productId = $request->getParam('product_id');
		$gallary_id = $request->getPost('gallary');
		$thumbnail = $request->getPost('thumbnail');
		$midium = $request->getPost('midium');
		$large = $request->getPost('large');
		$small = $request->getPost('small');
		$gallary = implode(',', $gallary_id);
		$adapter =$this->getAdapter();
		$sql = "UPDATE `image` SET `thumbnail` = 0 ,`base` = 0 , `midium` = 0 , `large` = 0 , `small` = 0,`gallary`= 0 WHERE `product_id`= $productId " ;
		$result =$adapter->update($sql);
		$sql = "UPDATE `image` SET `thumbnail` = 1 WHERE `img_id` = $thumbnail ;";
		$result =$adapter->update($sql);
		$sql = "UPDATE `image` SET `midium` = 1  WHERE `img_id` = $midium;";
		$result =$adapter->update($sql);
		$sql = "UPDATE `image` SET  `large` = 1  WHERE `img_id` = $large;";
		$result =$adapter->update($sql);
		$sql = "UPDATE `image` SET `small` = 1 WHERE `img_id` = $small;";
		$result =$adapter->update($sql);
		$sql = "UPDATE `image` SET `gallary` = 1 WHERE `img_id` IN ($gallary);";
		$result =$adapter->update($sql);
		$this->redirect("http://localhost/new_project/index.php?a=grid&c=product_media&product_id={$productId}");
	}
	
	function deleteAction()
	{	
		$request = $this->getRequest();
		$productId =$request->getParam('product_id');
		$delete_image_id = $request->getPost('delete_image');
		if($delete_image_id != null){
		$deleteImages = implode(',', $delete_image_id);
		$sql ="DELETE FROM `image` WHERE `image`.`img_id` IN ($deleteImages)";
		$adapter =$this->getAdapter();
		$results =$adapter->delete($sql);
		}		
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=product_media&product_id={$productId}");
	}

}

?>
<?php 
require_once 'Controller/Core/Action.php';
require_once 'Model/product_media.php';
/**
 * 
 */
class Controller_Product_Media extends Controller_Core_Action
{
	protected $productMedia = [];
	protected $modelProductMedia = null;
	function gridAction()
	{
		$request = $this->getRequest();
		$productId=$request->getParam('product_id');
		$sql ="SELECT * FROM `media` WHERE `product_id`= $productId ;";
		$modelProductMedia =$this->getModelProductMedia();
		$results =$modelProductMedia->fetchAll($sql);
		$this->setProductMedia($results);
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
		$media = $request->getPost('media');
		$targetName=(new \DateTime())->format('dHis').'i.'.$fileArray[1];
		$target_file = $target_dir .$targetName;
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		$media['img'] = $targetName;
		$modelProductMedia =$this->getModelProductMedia();
		$insert=$modelProductMedia->insert($media);
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
		$productId['product_id'] = $request->getParam('product_id');
		$gallary_id = $request->getPost('gallary');
		$thumbnail = $request->getPost('thumbnail');
		$midium = $request->getPost('midium');
		$large = $request->getPost('large');
		$small = $request->getPost('small');
		$modelProductMedia =$this->getModelProductMedia();
		$resetValue = array('thumbnail' => 0, 'base' => 0 ,'midium' => 0 ,'large' => 0, 'small' => 0, 'gallary' => 0);
		$result =$modelProductMedia->update($resetValue, $productId);
		$setThumbnail = array('thumbnail' => 1);
		$result =$modelProductMedia->update($setThumbnail, $thumbnail);
		$setMidium = array('midium' => 1);
		$result =$modelProductMedia->update($setMidium, $midium);
		$setLarge = array('large' => 1);
		$result =$modelProductMedia->update($setLarge, $large);
		$setSmall = array('small' => 1);
		$result =$modelProductMedia->update($setSmall, $small);
		$setGallary = array('gallary' => 1);
		foreach ($gallary_id as $key => $value) {
			$result =$modelProductMedia->update($setGallary, $value);
		}
		$this->redirect("http://localhost/new_project/index.php?a=grid&c=product_media&product_id={$productId['product_id']}");
	}
	
	function deleteAction()
	{	
		$request = $this->getRequest();
		$productId =$request->getParam('product_id');
		$delete_image_id = $request->getPost('delete_image');
		if($delete_image_id != null){
		$modelProductMedia =$this->getModelProductMedia();
		foreach ($delete_image_id as $key => $value) {
			$result =$modelProductMedia->delete($value);
		}
		}		
		return $this->redirect("http://localhost/new_project/index.php?a=grid&c=product_media&product_id={$productId}");
	}

    public function getModelProductMedia()
    {
        if(!$this->modelProductMedia)
        {
        	$this->modelProductMedia = new Model_ProductMedia();
        }
        return $this->modelProductMedia;
    }
    public function getProductMedia()
    {
        return $this->productMedia;
    }

    public function setProductMedia($productMedia)
    {
        $this->productMedia = $productMedia;

        return $this;
    }
}

?>
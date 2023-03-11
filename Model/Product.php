<?php 
/**
 * 
 */
require_once 'Core/Table.php';

class Model_Product extends Model_Core_Table
{
	// public $tableName = "products";
	// public $primaryKey = "product_id";


	 function __construct()
	{
	$this->setTableName('products');
	$this->setPrimaryKey('product_id');
	}

	public function fetchAll($query = null)
	{
		$tableName = $this->getTableName();
		if($query == null)
		{
		$sql ="SELECT * FROM `{$tableName}`";
		$adapter = $this->getAdapter();
		$result = $adapter->fetchAll($sql);
		}

		else
		{
			$result = $adapter->fetchAll($query);
		}
		
		return $result;
	}

	public function fetchRow($id, $query = null)
	{
		if($query == null)
		{
		$sql ="SELECT * FROM `{$this->tableName}` WHERE `{$this->primaryKey}`= '$id'";
		$adapter = $this->getAdapter();
		$result = $adapter->fetchRow($sql);
		}

		else
		{
			$result = $adapter->fetchRow($query);
		}

		return $result;
	}

	public function insert($data)
	{	
		if(!is_array($data))
		{
			throw new Exception("data not found.", 1);
			
		}

		$key =  implode('`,`', array_keys($data));
		$value =  implode('\',\'', $data);

		$sql = "INSERT INTO `{$this->tableName}` (`{$key}`) VALUES ('{$value}')";
		$adapter = $this->getAdapter();
		$adapter->insert($sql);
	}

	public function update($data,$condition)
	{
		$where = [];
		if(is_array($data))
		{
			foreach ($data as $key => $value)
			{
				$where [] =" `$key` = '$value'" ;
			}
		}
		$sql = "UPDATE `{$this->tableName}` SET ".implode(',', $where)." WHERE `{$this->primaryKey}`='{$condition}' ";


		$adapter = $this->getAdapter();
		$adapter->update($sql);
		// return true;
	}

	public function delete($condition)
	{
		$sql = "DELETE FROM `{$this->tableName}` WHERE `{$this->tableName}`.`{$this->primaryKey}` = '{$condition}'  ";
		$adapter = $this->getAdapter();
		$adapter->delete($sql);
	}
	

	
	
}

?>
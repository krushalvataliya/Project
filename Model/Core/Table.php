<?php 
require_once 'Model/Core/Adapter.php';
/**
 * 
 */
class Model_Core_Table
{
	
	public $tableName = null;
	public $primaryKey = null;
	public $adapter = null;

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

	public function setAdapter(Model_Core_Adapter $adapter)
	{
		$this->adapter = $adapter;
		return $this;
	}

    public function getTableName()
    {
        return $this->tableName;
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
        return $this;
    }

    public function fetchAll($query = null)
	{
		$tableName = $this->getTableName();
		$adapter = $this->getAdapter();
		if($query == null)
		{
		echo $sql ="SELECT * FROM `{$tableName}`";
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
		$adapter = $this->getAdapter();
		if(is_array($id))
		{
			$where = [];
			if(count($id) == 1)
			{
			foreach ($id as $key => $value) {
			$where [] =" `$key` = '{$value}'" ;
			}
			$sql ="SELECT * FROM `{$this->tableName}` WHERE ".implode(' ', $where);
			}
			else
			{
			foreach ($id as $key => $value)
			{
				$where [] =" `$key` = '$value'" ;
			}
			$sql ="SELECT * FROM `{$this->tableName}` WHERE " .implode('AND', $where) ;
			}
		}
		if($query == null && !is_array($id))
		{
		$sql ="SELECT * FROM `{$this->tableName}` WHERE `{$this->primaryKey}`= '$id'";
		}

		if($query != null)
		{
			$sql = $query;
		}
		$result = $adapter->fetchRow($sql);
		return $result;
	}

	public function insert($data)
	{	
		if(is_array($data))
		{
		$key =  implode('`,`', array_keys($data));
		$value =  implode('\',\'', $data);

		echo $sqlI = "INSERT INTO `{$this->tableName}` (`{$key}`) VALUES ('{$value}')";
		$adapter = $this->getAdapter();
		$result = $adapter->insert($sqlI);
		return $result;
		}

	}

	public function update($data,$condition)
	{
			foreach($data as $key => $value)
			{
				echo $key;
				$values [] =" `{$key}` = '{$value}'" ;
			}
		if(!is_array($condition))
		{
			
		echo $sql = "UPDATE `{$this->tableName}` SET ".implode(',', $values)." WHERE `{$this->primaryKey}`='{$condition}' ";
		}
		$where = [];
		if(is_array($condition))
		{
			foreach ($condition as $key => $value) {
			$where [] =" `$key` = '{$value}'" ;
			}
			if(count($condition) == 1)
			{
			echo $sql ="UPDATE `{$this->tableName}` SET ".implode(',', $values)." WHERE ".implode(' ', $where) ;
			}
			else
			{
			echo $sql ="UPDATE `{$this->tableName}` SET ".implode('AND', $values)." WHERE ".implode('AND', $where) ;
			}

		}
		$adapter = $this->getAdapter();
		$adapter->update($sql);
		return true;
	}

	public function delete($condition)
	{
		$sql = "DELETE FROM `{$this->tableName}` WHERE `{$this->tableName}`.`{$this->primaryKey}` = '{$condition}'  ";
		$adapter = $this->getAdapter();
		$adapter->delete($sql);
	}
	
}
 
?>
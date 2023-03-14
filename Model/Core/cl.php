<?php 

/**
 * 
 */
class table
{
	
	public $adapter = null;
	public $tableName = null;
	public $primaryKey = null;

	public function (argument)
	{
		// code...
	}

   
    public function getAdapter()
    {
       if($this->adapter)
       {
        return $this->adapter;
       }
       $adapter = new Model_Core_Adapter();
		$this->adapter = $adapter;
        return $this->adapter;
    }

   
    public function setAdapter($adapter)
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

    public function fetchAll($query)
    {
    	return $this->getAdapter()->fetchAll($query);
    }
    public function fetchRow($query)
    {
    	return $this->getAdapter()->fetchRow($query);
    }
}

?>
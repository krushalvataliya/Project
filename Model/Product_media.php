<?php 
require_once 'Core/Table.php';
/**
 * 
 */

class Model_ProductMedia extends Model_Core_Table
{

	 function __construct()
	{
		$this->setTableName('media');
		$this->setPrimaryKey('media_id');
	}

}

?>
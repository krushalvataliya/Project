<?php 
require_once 'Core/Table.php';
/**
 * 
 */

class Model_Cetegory extends Model_Core_Table
{

	 function __construct()
	{
		$this->setTableName('categories');
		$this->setPrimaryKey('category_id');
	}
	
}

?>
<?php 
require_once 'Core/Table.php';
/**
 * 
 */

class Model_Salesman extends Model_Core_Table
{

	 function __construct()
	{
		$this->setTableName('salesmen');
		$this->setPrimaryKey('salesman_id');
	}

}

?>
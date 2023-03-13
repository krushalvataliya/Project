<?php 
require_once 'Core/Table.php';
/**
 * 
 */

class Model_SalesmanPrice extends Model_Core_Table
{

	 function __construct()
	{
		$this->setTableName('salesman_price');
		$this->setPrimaryKey('entity_id');
	}

}

?>
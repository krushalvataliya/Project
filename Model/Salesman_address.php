<?php 
require_once 'Core/Table.php';
/**
 * 
 */

class Model_SalesmanAddress extends Model_Core_Table
{

	 function __construct()
	{
		$this->setTableName('salesman_address');
		$this->setPrimaryKey('address_id');
	}

}

?>
<?php 
require_once 'Core/Table.php';
/**
 * 
 */

class Model_CustomerAddress extends Model_Core_Table
{

	 function __construct()
	{
		$this->setTableName('customer_address');
		$this->setPrimaryKey('address_id');
	}

}

?>
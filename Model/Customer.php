<?php 
require_once 'Core/Table.php';
/**
 * 
 */

class Model_Customer extends Model_Core_Table
{

	 function __construct()
	{
		$this->setTableName('customers');
		$this->setPrimaryKey('customer_id');
	}

}

?>
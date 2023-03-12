<?php 
require_once 'Core/Table.php';
/**
 * 
 */

class Model_ShippingMethod extends Model_Core_Table
{

	 function __construct()
	{
		$this->setTableName('shiping_methods');
		$this->setPrimaryKey('shiping_method_id');
	}

}

?>
<?php 
require_once 'Core/Table.php';
/**
 * 
 */

class Model_PaymentMethod extends Model_Core_Table
{

	 function __construct()
	{
		$this->setTableName('payment_methods');
		$this->setPrimaryKey('payment_method_id');
	}

}

?>
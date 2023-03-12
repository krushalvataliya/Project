<?php 
require_once 'Core/Table.php';
/**
 * 
 */

class Model_Vendor extends Model_Core_Table
{

	 function __construct()
	{
		$this->setTableName('vendors');
		$this->setPrimaryKey('vendor_id');
	}

}

?>
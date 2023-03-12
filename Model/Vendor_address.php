<?php 
require_once 'Core/Table.php';
/**
 * 
 */

class Model_VendorAddress extends Model_Core_Table
{

	 function __construct()
	{
		$this->setTableName('vendor_address');
		$this->setPrimaryKey('address_id');
	}

}

?>
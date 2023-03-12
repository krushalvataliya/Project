<?php 
require_once 'Core/Table.php';
/**
 * 
 */

class Model_Product extends Model_Core_Table
{

	// public $tableName = 'products';
	// public $primaryKey = 'product_id';

	 function __construct()
	{
		$this->setTableName('products');
		$this->setPrimaryKey('product_id');
	}

}

?>
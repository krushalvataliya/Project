<?php 

class Model_core_Adapter{
	public $servername="localhost";
	public $username="root";
	public $password="";
	public $dbname ="product_db";

	public function connect(){
		$conn = mysqli_connect($this->servername, $this->username, $this->password ,$this->dbname);
		return $conn;
	   }  

   function fetchAll($query){
   	$connect =$this->connect();
   	$result =$connect->query($query);
   	if(!$result){
   		return false;
   	}
   		return $result->fetch_all(MYSQLI_ASSOC);
   }

   function fetchRow($query){
   	$connect =$this->connect();
   	$result =$connect->query($query);
   	if(!$result){
   		return false;
   	}
   		return $result->fetch_assoc();
   }
   
   function insert($query){
   	$connect =$this->connect();
   	$result =$connect->query($query);
   	if(!$result){
   		return false;
   	}
   		return $connect->insert_id;
   }

   function update($query){
   	$connect =$this->connect();
   	$result =$connect->query($query);
   	if(!$result){
   		return false;
   	}
   		return true;
   }

    function delete($query){
   	$connect =$this->connect();
   	$result =$connect->query($query);
   	if(!$result){
   		return false;
   	}
   		return true;
   }
   function query($query){
      $connect =$this->connect();
      $result =$connect->query($query);
      if(!$result){
         return false;
      }
         return $result->fetch_assoc();
   }

}
?> 	
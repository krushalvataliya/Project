<?php 

class Model_core_Adapter{
	public $servername="localhost";
	public $username="root";
	public $password="";
	public $dbname ="product_db";
   public $connect = null;

	public function connect(){
      if($this->connect == null)
      {
		$this->connect = mysqli_connect($this->servername, $this->username, $this->password ,$this->dbname);
      }

      return $this->connect;
	   }  

   public function fetchAll($query){
   	$connect =$this->connect();
   	$result =$connect->query($query);
   	if(!$result){
   		return false;
   	}
   		return $result->fetch_all(MYSQLI_ASSOC);
   }

   public function fetchRow($query){
   	$connect =$this->connect();
   	$result =$connect->query($query);
   	if(!$result){
   		return false;
   	}
   		return $result->fetch_assoc();
   }
   
   public function insert($query){
   	$connect =$this->connect();
   	$result =$connect->query($query);
   	if(!$result){
   		return false;
   	}
   		return $connect->insert_id;
   }

   public function update($query){
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
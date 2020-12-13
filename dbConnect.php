<?php

class DbConnect{

  private $con;

  public function connect()
  {
  	// require_once 'config.php';
  	include_once dirname(__FILE__).'/config.php';

  	$this->con = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
  	if (mysqli_connect_errno()) 
    {
  		echo "Failed to Connect with Database".mysqli_connect_err();              
  	}
  	return $this->con;
  }
}

?>
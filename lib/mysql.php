<?php
  function connect_db() {  
    $server = 'localhost'; // this may be an ip address instead  
    $user = 'root';  
    $pass = '********';  
    $database = 'web'; // name of your database  
    $connection = new mysqli($server, $user, $pass, $database);  
  
    if ($connection->connect_error) {
		$err='{"status":$err}';
		$err=json_decode($err);
		echo $err;
	}
	return $connection;
}

 
?>	

	

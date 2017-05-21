<?php
  function connect_db() {  
    $server = 'localhost'; // this may be an ip address instead  
    $user = 'root';  
    $pass = '134679852a';  
    $database = 'stu'; // name of your database  
    $connection = new mysqli($server, $user, $pass, $database);  
  
    if ($connection->connect_error) {
		die("连接失败: " . $conn->connect_error);
	}
	echo "连接成功<br />";
	return $connection;
}

 
?>	

	
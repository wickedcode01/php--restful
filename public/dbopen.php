<?php  
  
use \Psr\Http\Message\ServerRequestInterface as Request;  
use \Psr\Http\Message\ResponseInterface as Response;  
  
require '../vendor/autoload.php';  
require 'lib/mysql.php';  
  
$app = new Slim\App();  
  
$app->get('/', 'get_employee');  
  
$app->run();  
   
function get_employee() {  
     $db=connect_db();  
    $sql = "SELECT * FROM students";  
    $exe = $db->query($sql);  
    $data = $exe->fetch_all(MYSQLI_ASSOC);  
    $db = null;
	
    echo json_encode($data);
		
}
   
?>  
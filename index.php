<?php  
  
use \Psr\Http\Message\ServerRequestInterface as Request;  
use \Psr\Http\Message\ResponseInterface as Response;  
  
require 'vendor/autoload.php';  
require 'lib/mysql.php';  
  
$app = new Slim\App();  
  
$app->get('/', 'get_student');
$app->post('/user_add',function($request, $response, $args) {
     $parsedBody = $request->getParsedBody();
     add_user( $parsedBody);
    //add_user();//Request object’s <code>getParsedBody()</code> method to parse the HTTP request   
});
$app->get('/user/{id}', function($request, $response, $args) {  
    get_student_id($args['id']);  
});
$app->get('/getinfo','getinfo');
$app->get('/getteacher/{id}',function($request, $response, $args){
	get_teacher_id($args['id']);
});
$app->get('/p/{id}',function($request,$response,$args){
	getp($args['id']);
});
$app->post('/add_addicate',function($request, $response, $args){
    $parsedBody = $request->getParsedBody();
    add_addicate($parsedBody);
});
$app->get('/get_addicate/{id}',function($request, $response, $args){
    get_addicate($args['id']);
});
$app->run();  
   
function get_student() {
     $db=connect_db();  
    $sql = "SELECT * FROM students";  
    $exe = $db->query($sql);  
    $data = $exe->fetch_all(MYSQLI_ASSOC);  
    $db = null;
	
    echo json_encode($data);
		
}

function get_student_id($employee_id) {  
    $db = connect_db();  
    $sql = "SELECT * FROM students WHERE `sno` = '$employee_id'";  
    $exe = $db->query($sql);  
    $data = $exe->fetch_all(MYSQLI_ASSOC);  
    $db = null;  
    echo json_encode($data);  
}

function get_teacher_id($id){
	 $db = connect_db();  
    $sql = "SELECT * FROM teacher WHERE `tno` = '$id'";  
    $exe = $db->query($sql);  
    $data = $exe->fetch_all(MYSQLI_ASSOC);  
    $db = null;  
    echo json_encode($data); 
}  
   
function add_user($data) {  
    $db = connect_db();
    $sql = "insert into teacher (tno,tpw,tname)"."values('$data[un]','$data[pw]','$data[nickname]')";
    $exe = $db->query($sql);  
    $last_id = $db->insert_id;  
    $db = null;  
    if (!empty($last_id))  {
         echo "{\"status\":\"200\",\"id\":\"$last_id\"}";
    }
       
    else{
            echo "{\"status\":\"404\"}";
	}
}
function add_addicate($data){
     $db = connect_db();
    $sql = "insert into sp(pid,sno,time)"."values($data[pid],'$data[sno]','$data[time]')";
    $exe = $db->query($sql);  
   $last_id = $db->insert_id;  
    $db = null;  
    if ($exe)  {
         echo "{\"status\":\"200\",\"id\":\"$last_id\"}";
    }
    else{
            echo "{\"status\":\"404\"}";
	}
}
function get_addicate($id){
    	$db=connect_db();
	$sql="select * from sp join teacher on sp.sno=teacher.tno where pid=$id limit 100" ;
	 $exe = $db->query($sql);  
    $data = $exe->fetch_all(MYSQLI_ASSOC);  
    $db = null;  
    echo json_encode($data);  
}
function getinfo(){
	$db=connect_db();
	$sql="select pid ,pname,psrc,pbi,tname from projects inner join teacher on projects.tno=teacher.tno limit 10 ";
	 $exe = $db->query($sql);  
    $data = $exe->fetch_all(MYSQLI_ASSOC);  
    $db = null;  
    echo json_encode($data);  
}

function getp($id){
	$db=connect_db();
	$sql="select pid ,pin ,pname,tname,ptime from projects inner join teacher on teacher.tno=projects.tno where pid=$id";
	$exe=$db->query($sql);
	$data=$exe->fetch_all(MYSQLI_ASSOC);
	$db=null;
	echo json_encode($data);
}
?>  
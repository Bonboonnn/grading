<?php
require_once "controller/loginController.php";
$route = new Setting();
$route->url("/login", function(){
	define("DIR_RESTRICTED", true);
	require_once "route_auth.php";
	$login = new LoginController();
	$data = array(
		'uname' => $_POST['uname'],
		'upass' => $_POST['upass']
		);
	$response = $login->login($data);
	echo json_encode($response);
});
$route->url("/logout", function(){
	unset($_SESSION['user_data']);
	unset($_SESSION['access']);
	session_destroy();
	header('location: ../../');
});
$route->url("/", function(){
	if(isset($_SESSION['user_data'])){
		header('location: faculty');
	} else {
		header('location: ../../');
	}
});
$route->url("/backup", function(){
	define("DIR_RESTRICTED", true);
	require_once "route_auth.php";
	$ctrl = new Controller();
	$resp = $ctrl->backup();
	echo json_encode($resp);
});
$route->url("/restore", function(){
	define("DIR_RESTRICTED", true);
	require_once "route_auth.php";
 	$ctrl = new Controller();
 	$data = array(
 		"file" => $_FILES['restore_db']
 	);
 	$resp = $ctrl->restore($data);
 	echo json_encode($resp);
});
$route->run();
?>
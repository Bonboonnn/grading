<?php
require_once "settings.php";
require_once "controller/loginController.php";
$route = new Setting();
$route->url("/login", function(){
	require_once "route_auth.php";
	$login = new LoginController();
	$data = array(
		'uname' => $_POST['uname'],
		'upass' => $_POST['upass']
		);
	$response = $login->login($data);
	echo json_encode($response);
});
$route->url("/", function(){
	if(isset($_SESSION['user_data'])){
		header('location: faculty');
	} else {
		header('location: ../../');
	}
});
$route->run();
?>
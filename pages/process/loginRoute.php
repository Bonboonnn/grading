<?php
require_once "settings.php";
require_once "controller/loginController.php";
$route = new Setting();
$route->url("/login", function(){
	$login = new LoginController();
	$data = array(
		'uname' => $_POST['uname'],
		'upass' => $_POST['upass']
		);
	$response = $login->login($data);
	echo json_encode($response);
});
$route->url("/s", function(){
	$login = new LoginController();
	var_dump($login->s());
});
$route->run();
?>
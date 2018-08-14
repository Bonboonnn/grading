<?php
require_once "settings.php";
require_once "controller/loginController.php";
$route = new Setting();
$route->url("/login", function(){
	$login = new LoginController();
	var_dump($login->cons());
});
$route->run();
?>
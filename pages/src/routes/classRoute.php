<?php
require_once "controller/classController.php";
require_once "../../const.php";
$route = new Setting();
$route->url("class", function(){
	define('RESTRICTED', true); 
	require_once "auth.php";
	require_once ROOT_DIR.DS."/pages/class.php";
});
$route->url("class/add_class", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$class = new ClassController();
	$data = array(
		"yearlevel_id" => $_POST['yearlevel_id'],
		"className" => $_POST['classname']
	);
	$response = $class->add_class($data);
	echo json_encode($response);
});
$route->url("class/update_class", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$class = new ClassController();
	$data = array(
		"yearlevel_id" => $_POST['yearlevel_id'],
		"className" => $_POST['classname'],
		"class_id" => (int)$_POST['class_id']
	);
	$response = $class->update_class($data);
	echo json_encode($response);
});
$route->url("class/delete_class", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$data = array(
		"class_id" => (int)$_GET['class_id']
	);
	$class = new ClassController();
	$response = $class->delete_class($data);
	echo json_encode($response);
});
$route->url("class/get_classes", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$class = new ClassController();
	$response = $class->get_classes();
	echo json_encode($response);
});
$route->url("class/get_class_year", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$class = new ClassController();
	$data = array("yearlevel_id" => $_GET['yearlevel_id']);
	$response = $class->get_class_year($data);
	echo json_encode($response);
});
$route->run();
?>
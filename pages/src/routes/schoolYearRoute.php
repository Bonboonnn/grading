<?php
require_once "controller/schoolYearController.php";
require_once "../../const.php";
$route = new Setting();
$route->url("school-year", function(){
	define('RESTRICTED', true); 
	require_once "auth.php";
	require_once ROOT_DIR.DS."/pages/school-year.php";
});
$route->url("school-year/add_school_year", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$data = array(
		"schoolYear" => $_POST['schoolYear'],
		"semester" => $_POST['semester']
	);
	$scyear = new SchoolYearController();
	$response = $scyear->add_school_year($data);
	echo json_encode($response);
});
$route->url("school-year/get_school_years", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$scyear = new SchoolYearController();
	$response = $scyear->get_school_years();
	echo json_encode($response);
});
$route->url("school-year/delete_school_year", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$data = array(
		"schoolyear_id" => (int) $_GET['schoolyear_id']
	);
	$scyear = new SchoolYearController();
	$response = $scyear->delete_school_year($data);
	echo json_encode($response);
});
$route->url("school-year/update_school_year", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$data = array(
		"schoolYear" => $_POST['schoolYear'],
		"semester" => $_POST['semester'],
		"schoolyear_id" => (int) $_POST['schoolyear_id']
	);
	$scyear = new SchoolYearController();
	$response = $scyear->update_school_year($data);
	echo json_encode($response);
});
$route->run();
?>
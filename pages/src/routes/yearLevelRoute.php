<?php
require_once "controller/yearLevelController.php";
require_once "../../const.php";
$route = new Setting();
$route->url("year-level", function(){
	define('RESTRICTED', true); 
	require_once "auth.php";
	require_once ROOT_DIR.DS."/pages/year-level.php";
});
$route->url("year-level/add_year", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$data = array(
		"yearLevel" => $_POST['yearLevel']
	);
	$year = new YearLevelController();
	$response = $year->addYearLevel($data);
	echo json_encode($response);
});
$route->url("year-level/get_year_levels", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$year = new YearLevelController();
	$response = $year->getYearLevels();
	echo json_encode($response);
});
$route->url("year-level/delete_year_level", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$data = array(
		"yearlevel_id" => (int)$_GET['yearlevel_id']
	);
	$year = new YearLevelController();
	$response = $year->delete_year_level($data);
	echo json_encode($response);
});
$route->url("year-level/update_year_level", function(){
	$data = array(
		"yearLevel" => $_POST['yearLevel'],
		"yearlevel_id" => (int)$_POST['yearlevel_id']
	);
	$year = new YearLevelController();
	$response = $year->update_year_level($data);
	echo json_encode($response);
});
$route->run();
?>
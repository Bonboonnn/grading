<?php
require_once "controller/facultyController.php";

$route = new Setting();
$route->url("/faculty/display_faculty", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$faculty = new FacultyController();
	$response = $faculty->display_faculties();
	echo json_encode($response);
});
$route->url("/faculty/add_faculty", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$data = array(
		"facNo" => $_POST['facNo'],
		"fname" => $_POST['fname'],
		"mname" => $_POST['mname'],
		"lname" => $_POST['lname'],
		"course_id" => (int)$_POST['course_id'],
		"faculty_level" => (int)$_POST['level'],
		"username" => $_POST['username'],
		"password" => $_POST['password']
	);
	$faculty = new FacultyController();
	$response = $faculty->add_faculty($data);
	echo json_encode($response);
});
$route->url("get_user_details", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$data = array("faculty_id" => (int)$_GET['faculty_id']);
	$faculty = new FacultyController();
	$response = $faculty->get_user_details($data);
	echo json_encode($response);
});
$route->url("faculty/get_faculties_level", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$faculty = new FacultyController();
	$data = array(
		"faculty_level" => $_GET['faculty_level']
	);
	$response = $faculty->get_faculties_level($data);
	echo json_encode($response);
});
$route->url("/faculty/update_faculty", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	
	if($_SESSION['user_data']['login_level'] == 1) {
		$data = array(
			"facNo" => $_POST['facNo'],
			"fname" => $_POST['fname'],
			"mname" => $_POST['mname'],
			"lname" => $_POST['lname'],
			"course_id" => (int)$_POST['course_id'],
			"faculty_level" => (int)$_POST['level'],
			"username" => $_POST['username'],
			"password" => $_POST['password'],
			"faculty_id" => (int)$_POST['faculty_id']
		);
	} else {
		$data = array(
			"facNo" => $_POST['facNo'],
			"fname" => $_POST['fname'],
			"mname" => $_POST['mname'],
			"lname" => $_POST['lname'],
			"course_id" => (int)$_POST['course_id'],
			"username" => $_POST['username'],
			"password" => $_POST['password'],
			"faculty_id" => (int)$_POST['faculty_id']
		);
	}
	$faculty = new FacultyController();
	$response = $faculty->update_faculty($data);
	echo json_encode($response);
});
$route->url("/faculty/delete_faculty", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$data = array(
		"faculty_id" => (int)$_GET['faculty_id']
	);
	$faculty = new FacultyController();
	$response = $faculty->delete_faculty($data);
	echo json_encode($response);
});
$route->url("faculty", function(){
	define('RESTRICTED', true); 
	require_once "auth.php";
	require_once ROOT_DIR.DS."pages/faculty.php";
});
$route->run();
?>
<?php
require_once "settings.php";
require_once "controller/courseController.php";
$route = new Setting();
$route->url("/course/add_course", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$course = new CourseController();
	$data = array(
		"courseName" => $_POST['courseName'],
		"description" => $_POST['description']
	);
	$response = $course->add_course($data);
	echo json_encode($response);
});
$route->url("/course/get_courses", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$course = new CourseController();
	$response = $course->get_courses();
	echo json_encode($response);
});
$route->url("/course/update_course", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$data = array(
		"courseName" => $_POST['courseName'],
		"description" => $_POST['description'],
		"course_id" => (int)$_POST['course_id']
	);
	$course = new CourseController();
	$response = $course->update_course($data);
	echo json_encode($response);
});
$route->url('course/delete_course', function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$data = array(
		"course_id" => (int)$_GET['course_id']
	);
	$course = new CourseController();
	$response = $course->delete_course($data);
	echo json_encode($response);
});
$route->url("course", function(){
	define('RESTRICTED', true); 
	require_once "auth.php";
	require_once ROOT_DIR.DS."pages/course.php";
});
$route->run();
?>
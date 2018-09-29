<?php
require_once "controller/studentController.php";
require_once "controller/studentGradeController.php";
require_once "../../const.php";
$route = new Setting();
$route->url("student", function(){
	define('RESTRICTED', true); 
	require_once "auth.php";
	require_once ROOT_DIR.DS."/pages/student.php";
});
$route->url("student/add_student", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$student = new StudentController();
	$data = array(
		"studentIdNo" => $_POST['studentIdNo'],
		"student_fname" => $_POST['student_fname'],
		"student_lname" => $_POST['student_lname'],
		"student_mname" => $_POST['student_mname'],
		"course_id" => (int)$_POST['course_id'],
		"yearlevel_id" => (int)$_POST['yearlevel_id'],
		"class_id" => (int)$_POST['class_id'],
		"username" => $_POST['student_username'],
		"password" => $_POST['student_password']
	);
	$response = $student->add_student($data);
	echo json_encode($response);
});
$route->url("student/get_students", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$student = new StudentController();
	$response = $student->get_students();
	echo json_encode($response);
});
$route->url("student/update_student", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$student = new StudentController();
	$data = array(
		"studentIdNo" => $_POST['studentIdNo'],
		"student_fname" => $_POST['student_fname'],
		"student_lname" => $_POST['student_lname'],
		"student_mname" => $_POST['student_mname'],
		"course_id" => (int)$_POST['course_id'],
		"yearlevel_id" => (int)$_POST['yearlevel_id'],
		"class_id" => (int)$_POST['class_id'],
		"username" => $_POST['student_username'],
		"password" => $_POST['student_password'],
		"student_id" => (int)$_POST['student_id']
	);
	$response = $student->update_student($data);

	echo json_encode($response);
});
$route->url("student/delete_student", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$student = new StudentController();
	$data = array("student_id" => (int)$_GET['student_id']);
	$response = $student->delete_student($data);

	echo json_encode($response);
});

$route->url('student/student_view', function() {
	require_once ROOT_DIR.DS."/pages/student-page.php";
});

$route->url('student/student_infos', function() {
	$student = new StudentController();
	$data = array("student_idno" => $_GET['student_idno']);
	$response = $student->student_view($data);

	echo json_encode($response);
});
$route->run();
?>
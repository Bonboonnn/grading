<?php
require_once "controller/facultySubjectController.php";
require_once "controller/studentSubjectController.php";
require_once "../../const.php";
$route = new Setting();
$route->url("student-subject", function(){
	define("RESTRICTED", true);
	require_once "auth.php";
	require_once ROOT_DIR.DS."/pages/student-subject.php";
});

$route->url("student-subject/get_faculties", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$facSub = new FacultySubjectController();
	$data = array(
		"faculty_id" => $_GET['faculty_id']
	);
	$response = $facSub->get_faculties($data);
	echo json_encode($response);
});

$route->url("student-subject/add_student_subject", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$studSub = new StudentSubjectController();
	$data = array(
		"student_id" => $_POST['student_id'],
		"faculty_id" => $_POST['student_faculty_id'],
		"subject_id" => $_POST['studentSubject_id']
	);
	$response = $studSub->add_student_subject($data);
	echo json_encode($response);
});

$route->url("student-subject/update_student_subject", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$studSub = new StudentSubjectController();
	$data = array(
		"student_id" => $_POST['student_id'],
		"faculty_id" => $_POST['student_faculty_id'],
		"subject_id" => $_POST['studentSubject_id'],
		"studentsubject_id" => $_POST['student_subject_id']
	);
	$response = $studSub->update_student_subject($data);
	echo json_encode($response);
});

$route->url("student-subject/get_student_subjects", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$studSub = new StudentSubjectController();
	$response = $studSub->get_student_subjects();
	echo json_encode($response);
});

$route->url("student-subject/delete_student_subject", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$studSub = new StudentSubjectController();
	$data = array(
		"studentsubject_id" => $_GET['student_subject_id']
	);
	$response = $studSub->delete_student_subject($data);
	echo json_encode($response);
});
$route->run();
?>
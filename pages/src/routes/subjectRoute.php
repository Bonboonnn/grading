<?php
require_once "controller/subjectController.php";
require_once "../../const.php";
$route = new Setting();
$route->url("subject", function(){
	define('RESTRICTED', true); 
	require_once "auth.php";
	require_once ROOT_DIR.DS."/pages/subject.php";
});
$route->url("subject/add_subject", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$data = array(
		"subjectCode" => $_POST['subjectCode'],
		"subjectName" => $_POST['subjectName'],
		"unit" => $_POST['unit'],
		"yearlevel_id" => (int) $_POST['yearlevel_id'],
		"schoolyear_id" => (int) $_POST['schoolyear_id'],
	);
	$subject = new SubjectController();
	$response = $subject->add_subject($data);
	echo json_encode($response);
});
$route->url("subject/update_subject", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$data = array(
		"subjectCode" => $_POST['subjectCode'],
		"subjectName" => $_POST['subjectName'],
		"unit" => $_POST['unit'],
		"yearlevel_id" => (int) $_POST['yearlevel_id'],
		"schoolyear_id" => (int) $_POST['schoolyear_id'],
		"subject_id" => (int) $_POST['subject_id']
	);
	$subject = new SubjectController();
	$response = $subject->update_subject($data);
	echo json_encode($response);
});
$route->url("subject/delete_subject", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$data = array("subject_id" => $_GET['subject_id']);
	$subject = new SubjectController();
	$response = $subject->delete_subject($data);
	echo json_encode($response);
});
$route->url("subject/get_subjects", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$subject = new SubjectController();
	$response = $subject->get_subjects();
	echo json_encode($response);
});
$route->run();
?>
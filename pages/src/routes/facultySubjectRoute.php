<?php
require_once "controller/facultySubjectController.php";
require_once "../../const.php";
$route = new Setting();
$route->url("faculty-subject", function(){
	define('RESTRICTED', true); 
	require_once "auth.php";
	require_once ROOT_DIR.DS."/pages/faculty-subject.php";
});
$route->url("faculty-subject/add_faculty_subject", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$data = array(
		"faculty_id" => $_POST['faculty_id'],
		"subject_id" => $_POST['subject_id']
	);
	$facSub = new FacultySubjectController();
	$response = $facSub->add_faculty_subject($data);
	echo json_encode($response);
});
$route->run();
?>
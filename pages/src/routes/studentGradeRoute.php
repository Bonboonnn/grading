<?php
require_once "controller/studentGradeController.php";
require_once "controller/studentSubjectController.php";
require_once "controller/studentController.php";
require_once "controller/subjectController.php";
require_once "../../const.php";
$route = new Setting();
$route->url("student-grade", function(){
	define('RESTRICTED', true);
	require_once "auth.php";
	require_once ROOT_DIR.DS."/pages/student-grade.php";
});

$route->url("student-grade_faculty", function(){
	define('FACULTY', true);
	require_once "faculty_auth.php";
	require_once ROOT_DIR.DS."/pages/student-grade.php";
});

$route->url("student-grade/add_student_grade", function() {
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$student_grade = new StudentGradeController();
	$data = array(
		"student_id" => (int)$_POST['student_id'],
		"subject_id" => (int)$_POST['subject_id'],
		"faculty_id" => (int)$_POST['student_grade_faculty_id'],
		"course_id" => (int)$_POST['course_id'],
		"schoolyear_id" => (int)$_POST['schoolyear_id'],
		"prelim" => (double)$_POST['prelim_grade'],
		"midterm" => (double)$_POST['midterm_grade'],
		"final" => (double)$_POST['endterm_grade']
	);
	
	$response = $student_grade->add_student_grade($data);
	echo json_encode($response);
});

$route->url("student-grade/update_student_grade", function() {
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$student_grade = new StudentGradeController();
	$data = array(
		"student_id" => (int)$_POST['student_id'],
		"subject_id" => (int)$_POST['subject_id'],
		"faculty_id" => (int)$_POST['student_grade_faculty_id'],
		"course_id" => (int)$_POST['course_id'],
		"schoolyear_id" => (int)$_POST['schoolyear_id'],
		"prelim" => (double)$_POST['prelim_grade'],
		"midterm" => (double)$_POST['midterm_grade'],
		"final" => (double)$_POST['endterm_grade'],
		"studentgrade_id" => (int)$_POST['studentgrade_id']
	);
	$response = $student_grade->update_student_grade($data);
	echo json_encode($response);
});

$route->url("student-grade/delete_student_grade", function() {
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$student_grade = new StudentGradeController();
	$data = array(
		"studentgrade_id" => $_GET['student_grade_id']
	);
	$response = $student_grade->delete_student_grade($data);
	echo json_encode($response);
});

$route->url("student-grade/faculty_students", function() {
	define("FACULTY", true);
	require_once "faculty_auth.php";
	$student_grade = new StudentGradeController();
	$data = array(
		"faculty_id" => $_GET['faculty_id']
	);
	$response = $student_grade->faculty_students($data);
	echo json_encode($response);
});

$route->url("student-grade/get_student_grades", function() {
	define("RESTRICTED", true);
	require_once "route_auth.php";
	$student_grade = new StudentGradeController();
	$response = $student_grade->get_student_grades();
	echo json_encode($response);
});

$route->url("student-grade/get_student_faculties_course", function(){
	define('RESTRICTED', true); 
	require_once "route_auth.php";
	$student_grade = new StudentGradeController();
	$data = array(
		"student_id" => (int)$_GET['student_id']
	);

	$response = $student_grade->get_student_faculties_course($data);

	echo json_encode($response);
});

$route->url("student-grade/get_subject", function(){
	define("RESTRICTED", true);
	require_once "route_auth.php";

	$subject = new SubjectController();
	$data = array(
		"subject_id" => (int)$_GET['subject_id']
	);
	$response = $subject->get_subject($data);
	echo json_encode($response);
});

$route->url("student-grade/student_subjects", function(){
	define('RESTRICTED', true);
	require_once "route_auth.php";
	$studSub = new StudentSubjectController();
	$data = array(
		"student_id" => (int)$_GET['student_id'],
		"faculty_id" => (int)$_GET['faculty_id']
	);
	$response = $studSub->student_subjects($data);
	echo json_encode($response);
});

$route->url("student-grade/get_course", function(){
	define('RESTRICTED', true);
	require_once "route_auth.php";
	$data = array(
		"student_id" => (int)$_GET['student_id']
	);
	$student = new StudentController();
	$response = $student->get_course($data);
	echo json_encode($response);
});
$route->run();
?>
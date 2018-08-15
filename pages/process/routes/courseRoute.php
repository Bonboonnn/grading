<?php
require_once "settings.php";
require_once "controller/courseController.php";
$route = new Setting();
$route->url("/course/add_course", function(){
	$course = new CourseController();
	$data = array(
		"course_name" => $_POST['courseName'],
		"course_desc" => $_POST['description']
	);
	$response = $course->add_course($data);
	echo json_encode($response);
});
$route->url("/course/get_courses", function(){
	$course = new CourseController();
	$response = $course->get_courses();
	echo json_encode($response);
});
$route->run();
?>
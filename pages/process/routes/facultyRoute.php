<?php
require_once "settings.php";
require_once "controller/facultyController.php";
$route = new Setting();
$route->url("/faculty/display_faculty", function(){
	$faculty = new FacultyController();
	$response = $faculty->display_faculties();
	echo json_encode($response);
});
$route->run();
?>
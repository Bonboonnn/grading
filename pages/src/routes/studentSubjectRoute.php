<?php
require_once "controller/courseController.php";
require_once "../../const.php";
$route = new Setting();
$route->url("student-subject", function(){
	require_once ROOT_DIR.DS."/pages/student-subject.php";
});
$route->run();
?>
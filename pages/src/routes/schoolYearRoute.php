<?php
require_once "controller/courseController.php";
require_once "../../const.php";
$route = new Setting();
$route->url("school-year", function(){
	require_once ROOT_DIR.DS."/pages/school-year.php";
});
$route->run();
?>
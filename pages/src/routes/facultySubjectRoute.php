<?php
require_once "controller/courseController.php";
require_once "../../const.php";
$route = new Setting();
$route->url("faculty-subject", function(){
	require_once ROOT_DIR.DS."/pages/faculty-subject.php";
});
$route->run();
?>
<?php
require_once "settings.php";
require_once "controller/courseController.php";
require_once "../../const.php";
$route = new Setting();
$route->url("subject", function(){
	require_once ROOT_DIR.DS."/pages/subject.php";
});
$route->run();
?>
<?php
if(defined('RESTRICTED')){
	if(!isset($_SESSION['user_data']) && empty($_SESSION['user_data'])){
		header('location: ../../../'); 
	}
}
if(defined('DIR_RESTRICTED')){
	if(!isset($_SESSION['user_data']) && empty($_SESSION['user_data'])){
		header('location: ../../'); 
	}
}
?>
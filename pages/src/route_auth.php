<?php
if(defined('RESTRICTED')){

	if(!isset($_SESSION['user_data']) && empty($_SESSION['user_data'])){
		header('location: ../../../'); 
	}
	
}
if(defined('DIR_RESTRICTED')){

	if(!isset($_SESSION['user_data']) && empty($_SESSION['user_data'])){
		header('location: ../../'); 
	} else if($_SESSION['user_data']['login_level'] != 1) {
		header('location: student-grade');
	}

}
?>
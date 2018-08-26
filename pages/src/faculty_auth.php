<?php
if( defined('FACULTY')){
	if(!isset($_SESSION['user_data']) && empty($_SESSION['user_data'])){
		header('location: ../../'); 
	} 
	if($_SESSION['user_data']['login_level'] != 2 && !empty($_SESSION['user_data'])) {
		header('location: not_allowed');
	}
	
} else {
	if ( defined('SEND_TO_HOME') ) {
		if(isset( $_SESSION['user_data']) ) {
			if( $_SESSION['user_data']['login_level'] == 2 ) {
	      		header('location: pages/src/student-grade_faculty'); 
			}
		}
    } 
}
?>
<?php
if( defined('RESTRICTED')){
	if(!isset($_SESSION['user_data']) && empty($_SESSION['user_data'])){
		header('location: ../../'); 

	} else if($_SESSION['user_data']['login_level'] != 1) {
		header('location: student-grade');
	}
	
} else {
	if ( defined('SEND_TO_HOME') && isset( $_SESSION['user_data'] ) ) {
		if( $_SESSION['user_data']['login_level'] == 1 ) {
      		header('location: pages/src/faculty'); 

		} elseif( $_SESSION['user_data']['login_level'] == 2 ) {
			header('location: pages/src/student-grade'); 
		}
    } 
}
?>
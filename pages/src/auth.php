<?php
if( defined('RESTRICTED')){
	if(!isset($_SESSION['user_data']) && empty($_SESSION['user_data'])){
		header('location: ../../'); 
	} 
	else if($_SESSION['user_data']['login_level'] != 1 && !empty($_SESSION['user_data'])) {
		header('location: not_allowed');
	}	
} else {
	if ( defined('SEND_TO_HOME') ) {

		if(isset( $_SESSION['user_data']) ) {
			if( $_SESSION['user_data']['login_level'] == 1 ) {
	      		header('location: pages/src/faculty'); 

			}
		}
    } 
}
?>
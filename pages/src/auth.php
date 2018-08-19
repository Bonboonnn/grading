<?php
if( defined('RESTRICTED')){
	if(!isset($_SESSION['user_data']) && empty($_SESSION['user_data'])){
		header('location: ../../'); 
	}
} else {
	if ( defined('SEND_TO_HOME') && isset( $_SESSION['user_data'] ) ) {
      	header('location: pages/src/faculty'); 
    }    
}
?>
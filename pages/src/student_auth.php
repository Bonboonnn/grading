<?php
if( defined('STUDENT')){
	if(!isset($_SESSION['student_user']) && empty($_SESSION['student_user'])){
		header('location: ../../'); 
	} 	
} else {
	if ( defined('SEND_TO_HOME') ) {
		if(isset( $_SESSION['student_user']) ) {
	      	header('location: pages/src/student/student_view'); 
		}
    } 
}
?>
<?php
session_start();

if(isset($_SESSION['user_data'])){
	if($_SESSION['user_data']['login_level'] == 1) {
		header('location:src/faculty');
	} else if($_SESSION['user_data']['login_level'] == 2) {
		header('location:src/student-grade_faculty');
	}
} else {
	header('location: ../');
}
?>
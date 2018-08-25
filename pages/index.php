<?php
session_start();
if($_SESSION['user_data']['login_level'] == 1) {
	header('location:src/faculty');
} else if($_SESSION['user_data']['login_level'] == 2) {
	header('location:src/student-grade');
}
?>
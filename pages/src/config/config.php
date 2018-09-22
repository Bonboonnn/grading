<?php
class Config{
	public function __construct(){

	}
	public function connection(){
		return new mysqli('localhost', 'root', '', '2018_grading_db');
	}
}
?>
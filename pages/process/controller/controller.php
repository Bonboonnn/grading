<?php
require_once 'config/config.php';
class Controller extends Config{
	public function __construct(){
		parent::__construct();
	}
	public function getDbConnection(){
		return $this->connection();
	}
}
?>
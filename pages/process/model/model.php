<?php
require_once 'config/config.php';
class Model extends Config{
	public function __construct(){
		parent::__construct();
	}
	public function getDbConnection(){
		return $this->connection();
	}
}
?>
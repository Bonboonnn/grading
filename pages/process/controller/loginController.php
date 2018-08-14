<?php
require_once 'Controller.php';
class LoginController extends Controller{
	private $conn;
	public function __construct(){
		parent::__construct();
		$this->conn = $this->getDbConnection();
	}
	public function cons(){
		return $this->conn;
	}
}
?>
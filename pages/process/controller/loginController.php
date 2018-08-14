<?php
require_once 'Controller.php';
class LoginController extends Controller{
	private $conn;
	public function __construct(){
		parent::__construct();
		$this->conn = $this->getDbConnection();
	}
	public function login($data){
		return $response;
	}
	public function s(){
		$query = mysqli_query($this->conn, "select fname from tbl_student");
		return json_encode(mysqli_fetch_all($query, MYSQLI_ASSOC));
	}
}
?>
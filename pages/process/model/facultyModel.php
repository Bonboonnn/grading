<?php
require_once 'model.php';
class FacultyModel extends Model{
	private $conn;
	public function __construct(){
		parent::__construct();
		$this->conn = $this->getDbConnection();
	}
	public function display_faculties(){
		$sql = "select * from tblfaculty";
		$query = mysqli_query($this->conn, $sql);
		$response = mysqli_fetch_all($query, MYSQLI_ASSOC);
		return $response;
	}
}
?>
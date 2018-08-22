<?php
require_once 'model.php';
class SchoolYearModel extends Model{
	private $conn;
	public function __construct(){
		parent::__construct("tblschoolyear");
		$this->conn = $this->getDbConnection();
	}

	public function add_school_year($data){
		$this->authentication();
		$response = $this->insert($data);
		return $response;
	}

	public function get_school_years(){
		$this->authentication();
		$response = $this->select_all();
		return $response;
	}
}
?>
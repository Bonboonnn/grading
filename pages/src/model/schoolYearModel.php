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

	public function delete_school_year($data){
		$this->authentication();
		$conditions = array("schoolyear_id" => $data['schoolyear_id']);
		$response = $this->delete($conditions);
		return $response;
	}

	public function update_school_year($data){
		$this->authentication();
		$conditions = array(
			"schoolyear_id" => $data['schoolyear_id']
		);
		unset($data['schoolyear_id']);
		$response = $this->update($data, $conditions);
		return $response;
	}
}
?>
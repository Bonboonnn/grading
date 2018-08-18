<?php
require_once 'model.php';
class FacultyModel extends Model{
	private $conn;
	public function __construct(){
		parent::__construct("tblfaculty");
		$this->conn = $this->getDbConnection();
		
	}
	public function display_faculties(){
		$conditions = array(
			"table" => array("course")
		);
		$this->authentication();
		return $this->select_all_joins("inner", $conditions);
	}
	public function add_faculty($data){
		$data['password'] = hash("sha256", $data['facNo'].$data['password']);
		$this->authentication();
		return $this->insert($data);
	}
	public function update_faculty($data){
		$conditions = array("faculty_id" => $data['faculty_id']);
		unset($data['faculty_id']);
		$this->authentication();
		$response = $this->update($data, $conditions);
		return $response;
	}
	public function delete_faculty($data){
		$conditions = array("faculty_id" => $data['faculty_id']);
		$this->authentication();
		$response = $this->delete($conditions);
		return $response;
	}
}
?>
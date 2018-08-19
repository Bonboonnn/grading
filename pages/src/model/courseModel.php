<?php
require_once 'model.php';
class CourseModel extends Model{
	private $conn;
	public function __construct(){
		parent::__construct("tblcourse");
		$this->conn = $this->getDbConnection();
	}
	public function get_courses(){
		$this->authentication();
		$response = $this->select_all();
		return $response;
	}
	public function add_course($data){
		$this->authentication();
		$response = $this->insert($data);
		return $response;
	}
	public function update_course($data){
		$this->authentication();
		$conditions = array("course_id" => $data['course_id']);
		unset($data['course_id']);
		$response = $this->update($data, $conditions);
		return $response;
	}
	public function delete_course($data){
		$conditions = array("course_id" => $data['course_id']);
		$this->authentication();
		$response = $this->delete($conditions);
		return $response;
	}
}
?>
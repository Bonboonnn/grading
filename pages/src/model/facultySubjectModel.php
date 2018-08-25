<?php
require_once 'model.php';

class FacultySubjectModel extends Model {
	private $conn;
	public function __construct(){
		parent::__construct("tblfacultysubject");
		$this->conn = $this->getDbConnection();
	}

	public function get_faculty_subjects() {
		$conditions = array(
			"table" => array("faculty","subject")
		);
		$this->authentication();
		return $this->select_all_joins("inner", $conditions);
	}

	public function add_faculty_subject($data) {
		$this->authentication();
		$response = $this->insert($data);
		return $response;
	}

	public function update_faculty_subject($data) {
		$this->authentication();
		$conditions = array("faculty_subject_id" => $data['faculty_subject_id']);
		unset($data['faculty_subject_id']);
		$response = $this->update($data, $conditions);
		return $response;
	}

	public function delete_faculty_subject($data) {
		$this->authentication();
		$response = $this->delete($data);
		return $response;
	}

	public function get_faculties($data) {
		$this->authentication();
		$conditions = array(
			"condition" => array(
				"tblfacultysubject" => array(
					"data" => array("faculty_id" => $data['faculty_id']),
					"operator" => ""
				)
			),
			"joins" => array(
				"table" => array(
					"inner" => "subject",
				)
			)
		);
		$response = $this->select_one($conditions);
		return $response;
	}
}
?>
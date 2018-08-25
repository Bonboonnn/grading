<?php
require_once 'model.php';
class StudentSubjectModel extends Model {
	private $conn;
	public function __construct(){
		parent::__construct('tblstudentsubject');
		$this->conn = $this->getDbConnection();
	}

	public function get_student_subjects() {
		$this->authentication();
		$condition = array(
			"table" => array("faculty", "subject", "student")
		);
		$response = $this->select_all_joins("inner", $condition);
		return $response;
	}

	public function add_student_subject($data) {
		$this->authentication();
		$response = $this->insert($data);
		return $response;
	}

	public function update_student_subject($data) {
		$this->authentication();
		$this->authentication();
		$conditions = array("studentsubject_id" => $data['studentsubject_id']);
		unset($data['studentsubject_id']);
		$response = $this->update($data, $conditions);
		return $response;
	}

	public function delete_student_subject($data) {
		$this->authentication();
		$response = $this->delete($data);
		return $response;
	}
}
?>
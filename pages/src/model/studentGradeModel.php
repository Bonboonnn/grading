<?php
require_once 'model.php';
class StudentGradeModel extends Model {
	private $conn;
	public function __construct() {
		parent::__construct("tblstudentgrade");
		$this->conn = $this->getDbConnection();
	}

	public function add_student_grade($data) {
		$this->authentication();
		$response = $this->insert($data);
		return $response;
	}

	public function get_student_grades() {
		$this->authentication();
		$conditions = array(
			"joins" => array(
				"faculty" => array("fname", "lname", "mname", "faculty_id"),
				"student" => array("student_fname", "student_lname", "student_mname", "student_id"),
				"schoolyear" => array("schoolyear_id", "schoolYear", "semester"),
				"course" => array("courseName", "course_id", "description"),
				"subject" => array("subjectName", "subject_id"),
				"" => array("studentgrade_id","prelim", "midterm", "final", "finalGrade", "remarks")
			),
			"type" => array("inner","inner","inner","inner","inner","")
		);
		$response = $this->select_joins($conditions);
		return $response;
	}

	public function update_student_grade($data) {
		$this->authentication();
		$conditions = array("studentgrade_id" => $data['studentgrade_id']);
		unset($data['studentgrade_id']);
		$response = $this->update($data, $conditions);
		return $response;
	}

	public function delete_student_grade($data) {
		$this->authentication();
		$conditions = array("studentgrade_id" => $data['studentgrade_id']);
		$response = $this->delete($conditions);
		return $response;
	}
}
?>
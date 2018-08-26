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

	public function get_student_faculties($data) {
		$this->authentication();
		$conditions = array(
			"condition" => array(
				"student_id" => $data['student_id']
			),
			"clause" => array(""),
			"opt" => "DISTINCT",
			"joins" => array(
				"faculty" => array("fname", "lname", "mname", "faculty_id"),
			),
			"type" => array("inner",)
		);
		$response = $this->select_joins($conditions);
		return $response;
	}

	public function get_faculty_students($data) {
		$this->authentication();
		$response = array();
		$conditions = array(
			"condition" => array(
				"faculty_id" => $data['faculty_id']
			),
			"clause" => array(""),
			"opt" => "DISTINCT",
			"joins" => array(
				"student" => array("student_fname", "student_lname", "student_mname", "student_id"),
				"subject" => array("subjectName", "subject_id"),
				"faculty" => array("faculty_id", "fname", "lname", "mname")
			),
			"type" => array("inner", "inner", "inner")
		);

		$cond = array(
			"faculty_id" => $data['faculty_id']
		);

		$sql = "select c.courseName, sy.semester, sy.schoolYear, sy.schoolyear_id from tblstudentsubject as tblstudentsubject inner join tblstudent as s on s.student_id = tblstudentsubject.student_id inner join tblcourse as c on c.course_id = s.course_id inner join tblsubject as sub on sub.subject_id = tblstudentsubject.subject_id inner join tblschoolyear as sy on sy.schoolyear_id = sub.schoolyear_id where ";

		$course_result = $this->raw_query($sql, $cond);

		$student_subject_result = $this->select_joins($conditions);

		foreach($course_result as $key => $value) {
			$student_subject_result[$key] += $value;
		}
		
		$response = $student_subject_result;

		// echo "<pre>";
		// print_r($response);
		// echo "<pre>";

		return $response;
	}

	public function student_subjects($data) {
		$this->authentication();
		$conditions = array(
			"condition" => array(
				"student_id" => $data['student_id'],
				"faculty_id" => $data['faculty_id']
			),
			"clause" => array("AND",""),
			"opt" => "",
			"joins" => array(
				"subject" => array("subjectName", "subject_id"),
			),
			"type" => array("inner",)
		);
		$response = $this->select_joins($conditions);
		return $response;
	}

	public function update_student_subject($data) {
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
<?php
require_once 'model.php';
class StudentModel extends Model {
	private $conn;
	public function __construct(){
		parent::__construct("tblstudent");
		$this->conn = $this->getDbConnection();
	}

	public function add_student($data){
		$data['created'] = date('Y-m-d');
		$data['password'] = hash("sha256", $data['created'].$data['password']);
		$this->authentication();
		return $this->insert($data);
	}

	public function get_students(){
		$conditions = array(
			"table" => array("course", "yearlevel", "class")
		);
		$this->authentication();
		return $this->select_all_joins("inner", $conditions);
	}

	public function check_parsed_data($params) {
		$sql = "select s.student_id, stdsub.subject_id, stdsub.faculty_id, sc.schoolyear_id, s.course_id from tblstudent as s inner join tblstudentsubject as stdsub on stdsub.student_id = s.student_id inner join tblsubject as sub on sub.subject_id = stdsub.subject_id inner join tblschoolyear as sc on sc.schoolyear_id = sub.schoolyear_id inner join tblfaculty as fac on fac.faculty_id=stdsub.faculty_id inner join tblcourse as c on c.course_id = s.course_id where s.studentIdNo = '".$params['std_idno']."' and sub.subjectName = '".$params['subject']."' and (c.courseName like '%".$params['course']."%' or c.description like '%".$params['course']."%' ) and sc.schoolYear = '".$params['schoolyear']."'";
		$response = $this->raw_query($sql);
		$res = array_shift($response);
		return $res;
	}

	public function get_course($data){
		$this->authentication();
		$conditions = array(
			"condition" => array(
				"student_id" => $data['student_id']
			),
			"clause" => array(""),
			"opt" => "",
			"joins" => array(
				"course" => array("description", "course_id"),
			),
			"type" => array("inner",)
		);
		$response = $this->select_joins($conditions);
		return $response;
	}
	public function update_student($data){
		$conditions = array("student_id" => $data['student_id']);
		$conditions_password = array(
			"condition" => array(
				"tblstudent" => array(
					"data" => array("student_id" => $data['student_id']),
					"operator" => ""
				)
			)
		);

		unset($data['student_id']);	
		$this->authentication();
		$result = $this->select_one($conditions_password);
		$result = array_shift($result);
		if($data['password'] == $result['password']){
			$data['password'] = $result['password'];
		} else {
			$data['password'] = hash("sha256", $result['created'].$data['password']);
		}
		$response = $this->update($data, $conditions);

		return $response;
	}

	public function delete_student($data){
		$conditions = array("student_id" => $data['student_id']);
		$this->authentication();
		$response = $this->delete($conditions);

		return $response;
	}

	public function student_view($data) {
		$this->authentication();
		$conditions = array(
			"condition" => array(
				"studentIdNo" => $data['student_idno']
			),
			"clause" => array(""),
			"joins" => array(
				"course" => array("description"),
				"yearlevel" => array("yearLevel"),
				"" => array("studentIdno","student_fname", "student_mname", "student_lname", "student_id")
			),
			"type" => array("inner", "inner", "")
		);
		$response = $this->select_joins($conditions);
		return $response;
	}

	public function student_login($data) {
		$conditions = array(
			"condition" => array(
				"tblstudent" => array(
					"data" => array("username" => $data[0]['username']),
					"operator" => ""
				)
			)
		);
		$result = $this->select_one($conditions);
		$res = $result;
		$result =  array_shift($result);
		if(count($res)){
			$data[0]['password'] = hash("sha256", $result['created'].$data[0]['password']);
			if( $data[0]['password'] === $result['password'] ) {
				$_SESSION['student_user'] = array(
					"student_id" => $result['student_id'],
					"studentIdNo" => $result['studentIdNo'],
					'username' => $result['username']
				);
				$response = $this->response("success", "Login Success");
			} else {
				$response = $this->response("failed", "Incorrect Password");
			}
				
		} else {
			$response = $this->response("failed", "Username does not exists!");
		}
		return $response;
	}

	public function student_change_pass($data) {
		$conditions = array("username" => $data['username']);
		$conditions_password = array(
			"condition" => array(
				"tblstudent" => array(
					"data" => array("username" => $data['username']),
					"operator" => ""
				)
			)
		);
		unset($data['username']);	
			
		$this->authentication();
		$result = $this->select_one($conditions_password);
		$result = array_shift($result);
		$data[0]['oldPass'] = hash('sha256', $result['created'].$data[0]['oldPass']);
		if($result['password'] == $data[0]['oldPass']) {
			$data['password'] = hash("sha256", $result['created'].$data[0]['newPass']);
			unset($data[0]);	
			$response = $this->update($data, $conditions);
		} else {
			$response = $this->response('error', "Incorrect old password");
		}
		// echo "<pre>";
		// print_r($data);	
		return $response;
	}
}
?>
<?php
require_once 'model.php';
class LoginModel extends Model{
	private $conn;
	public function __construct(){
		parent::__construct();
		$this->conn = $this->getDbConnection();
	}
	public function login($data){
		$sql = "select facNo, fname, mname, lname, course_id, faculty_level, password from tblfaculty where username = ?";
		$query = $this->conn->prepare($sql) or die(mysqli_error($this->conn));
		$query->bind_param('s', $data['uname']);
		$query->execute();
		$query->bind_result($fac_no, $fname, $mname, $lname, $course_id, $faculty_level, $password);
		$query->store_result();
		$query->fetch();
		if($query->num_rows() > 0){
			if($password == $data['upass']){
				$response = array(
					"status"=> "success",
					"data" 	=> array(
						"fac_no" 		=> $fac_no,
						"fname" 		=> $fname,
						"mname" 		=> $mname,
						"lname" 		=> $lname,
						"course_id" 	=> $course_id,
						"faculty_level" => $faculty_level
					)
				);
				$_SESSION['user_data'] = array(
					"user_fname" => $fname,
					"user_mname" => $mname,
					"user_lname" => $lname,	
					"user_name"  => $data['uname']
				);
			} else {
				$response = array(
					"status" => "error",
					"message" => "Password do not match!"
				);
			}
		} else {
			$response = array(
					"status" => "error",
					"message" => "Username does not exists!"
				);
		}
		return $response;
	}
}
?>
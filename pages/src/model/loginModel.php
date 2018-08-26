<?php
require_once 'model.php';
class LoginModel extends Model{
	private $conn;
	public function __construct(){
		parent::__construct("tblfaculty");
		$this->conn = $this->getDbConnection();
	}
	public function login($data){
		$conditions = array(
			"condition" => array(
				"tblfaculty" => array(
					"data" => array("username" => $data['uname']),
					"operator" => ""
				)
			)
		);
		$result = $this->select_one($conditions);
		$res = $result;
		$result =  array_shift($result);
		if(count($res)){
			$data['upass'] = hash("sha256", $result['created'].$data['upass']);
			$level = "";
			if( $data['upass'] === $result['password'] ) {
				if( $result['faculty_level'] == $data['level'] ) {
					$response = $this->response("success", "");
					$_SESSION['user_data'] = array(
						"user_id"	 	=> $result['faculty_id'],
						"user_fname" 	=> $result['fname'],
						"user_mname" 	=> $result['mname'],
						"user_lname" 	=> $result['lname'],
						"user_name"  	=> $data['uname'],
						"user_password" => $result['password'],
						"login_level" => $result['faculty_level']
					);
					$_SESSION['access'] = GRANTED;
				} else {
					if($data['level'] == "1") {
						$level = "Admin";
					} else {
						$level = "Faculty / Teacher";

					}
					$response = $this->response("error", "Your account does not exists in ".$level." level");
				}
			} else {
				$response = $this->response("error", "Incorrect password");
			}
		} else {
			$response = $this->response("error", "Username does not exists!");
		}
		return $response;
	}
}
?>
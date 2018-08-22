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
		$data['created'] = date('Y-m-d');
		$data['password'] = hash("sha256", $data['created'].$data['password']);
		$this->authentication();
		return $this->insert($data);
	}
	public function update_faculty($data){
		$conditions = array("faculty_id" => $data['faculty_id']);
		if($data['course_id'] === 0){
			unset($data['course_id']);
		}
		$conditions_password = array(
			"condition" => array(
				"tblfaculty" => array(
					"data" => array("faculty_id" => $data['faculty_id']),
					"operator" => ""
				)
			)
		);
		unset($data['faculty_id']);	
		$this->authentication();
		$result = $this->select_one($conditions_password);
		$result = array_shift($result);
		if($data['password'] == $result['password']){
			$data['password'] = $result['password'];
		} else {
			$data['password'] = hash("sha256", $result['created'].$data['password']);
		}
		$response = $this->update($data, $conditions);
		if($response['status'] == "success"){
			$_SESSION['user_data'] = array(
					"user_id"	 	=> $conditions['faculty_id'],
					"user_fname" 	=> $data['fname'],
					"user_mname" 	=> $data['mname'],
					"user_lname" 	=> $data['lname'],
					"user_name"  	=> $data['username'],
					"user_password" => $data['password']
				);
		}
		return $response;
	}
	public function get_user_details($data){
		/* Inside index condition is alias => tbl columm => column name and data inside of 
			operator is boolean operator eg AND, OR
		 	(if you want to add another condition just add another array )
			ex. "course" => array("data" => array("course_id" => "testData")), "operator" => "and"

			note the alias in condition index should be the same in the alias in joins index
		 	Inside joins is alias and type of join

			(data, operator, and table) indices should not be changed

		 */
		$conditions = array(
			"condition" => array(
				"tblfaculty" => array(
					"data" => array("faculty_id" => $data['faculty_id']),
					"operator" => ""
				)
			),
			"joins" =>  array(
				"table" => array("left" => "course"),
			)
		);
		$this->authentication();
		$response = $this->select_one($conditions);
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
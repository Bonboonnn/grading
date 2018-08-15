<?php
require_once 'model.php';
class CourseModel extends Model{
	private $conn;
	public function __construct(){
		parent::__construct();
		$this->conn = $this->getDbConnection();
	}
	public function get_courses(){
		$sql = "select * from tblcourse";
		$query = mysqli_query($this->conn, $sql);
		$response = mysqli_fetch_all($query, MYSQLI_ASSOC);
		return $response;
	}
	public function add_course($data){
		$sql = "insert into tblcourse (courseName, description) values (?, ?)";
		$query = $this->conn->prepare($sql);
		$query->bind_param('ss', $data['course_name'], $data['course_desc']);
		if($query->execute()){
			$response = array(
				"status" => "success",
				"message" => "Course Added"
			);
		} else {
			$response = array(
				"status" => "error",
				"message" => "Failed to Add Course"
			);
		}
		return $response;
	}
}
?>
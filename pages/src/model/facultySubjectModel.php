<?php
require_once 'model.php';

class FacultySubjectModel extends Model {
	private $conn;
	public function __construct(){
		parent::__construct("tblfacultysubject");
		$this->conn = $this->getDbConnection();
	}

	public function get_faculty_subjects() {
		
	}

	public function add_faculty_subject($data) {

	}

	public function update_faculty_subject($data) {

	}

	public function delete_faculty_subject($data) {

	}
}
?>
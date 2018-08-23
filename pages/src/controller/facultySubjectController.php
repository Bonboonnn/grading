<?php
require_once 'controller.php';
require_once 'model/facultySubjectModel.php';
class FacultySubjectController extends Controller {
	private $model;
	public function __construct(){
		parent::__construct();
		$this->model = new FacultySubjectModel();
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
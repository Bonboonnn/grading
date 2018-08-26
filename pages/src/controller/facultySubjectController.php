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
		$response = $this->model->get_faculty_subjects();
		return $response;
	}

	public function add_faculty_subject($data) {
		$response = $this->model->add_faculty_subject($data);
		return $response;
	}

	public function update_faculty_subject($data) {
		$response = $this->model->update_faculty_subject($data);
		return $response;
	}

	public function delete_faculty_subject($data) {
		$response = $this->model->delete_faculty_subject($data);
		return $response;
	}

	public function get_faculties($data) {
		$response = $this->model->get_faculties($data);
		return $response;
	}

}
?>
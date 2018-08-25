<?php
require_once 'controller.php';
require_once 'model/studentSubjectModel.php';
class StudentSubjectController extends Controller {
	private $model;
	public function __construct(){
		parent::__construct();
		$this->model = new StudentSubjectModel();
	}

	public function get_student_subjects() {
		$response = $this->model->get_student_subjects();
		return $response;
	}

	public function add_student_subject($data) {
		$response = $this->model->add_student_subject($data);
		return $response;
	}

	public function update_student_subject($data) {
		$response = $this->model->update_student_subject($data);
		return $response;
	}

	public function delete_student_subject($data) {
		$response = $this->model->delete_student_subject($data);
		return $response;
	}

}
?>
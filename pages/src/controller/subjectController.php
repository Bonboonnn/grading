<?php
require_once "controller.php";
require_once "model/subjectModel.php";

class SubjectController extends Controller {

	private $model;

	public function __construct(){
		parent::__construct();
		$this->model = new SubjectModel();
	}

	public function add_subject($data) {
		$validate = $this->validations($data);

		if($validate) {
			$response = $this->model->add_subject($data);
		} else {
			$response = array(
				"status" => "error",
				"message" => "Please input missing fields"
			);
		}

		return $response;
	}

	public function get_subjects() {
		$response = $this->model->get_subjects();
		return $response;
	}

	public function update_subject($data) {
		$response = $this->model->update_subject($data);
		return $response;
	}

	public function delete_subject($data) {
		$response = $this->model->delete_subject($data);
		return $response;
	}
}
?>
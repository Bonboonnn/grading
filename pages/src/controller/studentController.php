<?php
require_once 'controller.php';
require_once 'model/studentModel.php';
class StudentController extends Controller {
	private $model;
	public function __construct(){
		parent::__construct();
		$this->model = new StudentModel();
	}

	public function add_student($data){
		$validates = $this->validations($data);

		if($validates){
			$response = $this->model->add_student($data);
		} else {
			$response = array(
				"status" => "error",
				"message" => "Please input missing fields"
			);
		}

		return $response;
	}

	public function update_student($data){
		$validates = $this->validations($data);

		if($validates){
			$response = $this->model->update_student($data);
		} else {
			$response = array(
				"status" => "error",
				"message" => "Please input missing fields"
			);
		}

		return $response;
	}

	public function get_students(){
		$response = $this->model->get_students();

		return $response;
	}

	public function delete_student($data){
		$response = $this->model->delete_student($data);

		return $response;
	}

	public function get_course($data) {
		$response = $this->model->get_course($data);

		return $response;
	}
}
?>
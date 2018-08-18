<?php
require_once 'controller.php';
require_once 'model/courseModel.php';
class CourseController extends Controller{
	private $model;
	public function __construct(){
		parent::__construct();
		$this->model = new CourseModel();
	}
	public function add_course($data){
		$validates = $this->validations($data);
		if($validates){
			$response = $this->model->add_course($data);
		} else {
			$response = array(
				"status" => "error",
				"message" => "Please input missing fields"
			);
		}
		return $response;
	}

	public function update_course($data){
		$validates = $this->validations($data);
		if($validates){
			$response = $this->model->update_course($data);
		} else {
			$response = array(
				"status" => "error",
				"message" => "Please input missing fields"
			);
		}
		return $response;
	}

	public function delete_course($data){
		$response = $this->model->delete_course($data);
		return $response;
	}

	public function get_courses(){
		$response = $this->model->get_courses();
		return $response;
	}
}
?>
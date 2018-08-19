<?php
require_once 'controller.php';
require_once 'model/classModel.php';
class ClassController extends Controller{
	private $model;
	public function __construct(){
		parent::__construct();
		$this->model = new ClassModel();

	}

	public function add_class($data){
		$validates = $this->validations($data);

		if($validates){
			$response = $this->model->add_class($data);
		} else {
			$response = array(
				"status" => "error",
				"message" => "Please input missing fields"
			);
		}

		return $response;
	}

	public function get_class_year($data){
		$response = $this->model->get_class_year($data);

		return $response;
	}

	public function get_classes(){
		$response = $this->model->get_classes();

		return $response;
	}
}
?>
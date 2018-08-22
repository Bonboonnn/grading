<?php
require_once 'controller.php';
require_once 'model/schoolYearModel.php';
class SchoolYearController extends Controller{
	private $model;
	public function __construct(){
		parent::__construct();
		$this->model = new SchoolYearModel();
	}

	public function add_school_year($data) {
		$validates = $this->validations($data);
		if($validates){
			$response = $this->model->add_school_year($data);
		} else {
			$response = array(
				"status" => "error",
				"message" => "Please input missing fields"
			);
		}
		return $response;
	}

	public function get_school_years(){
		$response = $this->model->get_school_years();
		return $response;
	}
}
?>
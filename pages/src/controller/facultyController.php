<?php
require_once 'controller.php';
require_once 'model/facultyModel.php';
class FacultyController extends Controller{
	private $model;
	public function __construct(){
		parent::__construct();
		$this->model = new FacultyModel();
	}
	public function display_faculties(){
		$response = $this->model->display_faculties();
		return $response;
	}
	public function add_faculty($data){
		$validates = $this->validations($data);
		if($validates){
			$response = $this->model->add_faculty($data);
		} else {
			$response = array(
				"status" => "error",
				"message" => "Please input missing fields"
			);
		}
		return $response;
	}
	public function update_faculty($data){
		$response = $this->model->update_faculty($data);
		return $response;
	}
	public function get_user_details($data){
		$response = $this->model->get_user_details($data);
		return $response;
	}
	public function delete_faculty($data){
		$response = $this->model->delete_faculty($data);
		return $response;
	}
}
?>
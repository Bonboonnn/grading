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
}
?>
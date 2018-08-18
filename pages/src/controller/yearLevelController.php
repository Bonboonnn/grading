<?php
require_once 'controller.php';
require_once 'model/yearLevelModel.php';
class YearLevelController extends Controller {
	private $model;
	public function __construct(){
		parent::__construct();
		$this->model = new YearLevelModel();
	}
	public function addYearLevel($data){
		$response = $this->model->addYearLevel($data);
		return $response;
	}
	public function getYearLevels(){
		$response = $this->model->getYearLevels();
		return $response;
	}
	public function update_year_level($data){
		$response = $this->model->update_year_level($data);
		return $response;
	}
	public function delete_year_level($data){
		$response = $this->model->delete_year_level($data);
		return $response;
	}
}
?>
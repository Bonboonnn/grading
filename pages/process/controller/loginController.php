<?php
require_once 'controller.php';
require_once 'model/loginModel.php';
class LoginController extends Controller{
	private $model;
	public function __construct(){
		parent::__construct();
		$this->model = new LoginModel();
	}
	public function login($data){
		$validates = $this->validations($data);
		if($validates){
			$response = $this->model->login($data);
		} else {
			$response = array(
				"status" => "error",
				"message" => "Please input missing fields"
			);
		}
		
		return $response;
	}
}
?>
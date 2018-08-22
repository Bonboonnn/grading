<?php
class Controller{
	public function __construct(){
		
	}
	public function validations($form_datas){
		$count = 0;
		$validate = false;
		foreach($form_datas as $form_data){
			if(isset($form_data) && !empty($form_data)){
				$count++;
			}
		}
		if($count == count($form_datas)){
			$validate = true;
		}
		return $validate;
	}

	public function backup(){
		require_once "model/model.php";
		$model = new Model(null);
		return $model->backup();
	}

	public function restore($data){
		require_once "model/model.php";
		$model = new Model(null);
		return $model->restore($data);
	}
}
?>
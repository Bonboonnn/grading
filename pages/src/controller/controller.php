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

	public function parse_csv_data($data) {
		$csv_contents = array();
		if (($parser = fopen($data['tmp_name'], "r")) !== FALSE) {
		    while (($data = fgetcsv($parser, 1000, ",")) !== FALSE) {
		        $csv_contents[]=$data;
		    }
		    fclose($parser);
		    array_walk($csv_contents, function(&$tmp) use ($csv_contents) {
		    	$tmp = array_combine($csv_contents[0], $tmp);
		    });
		    array_shift($csv_contents);

			return $csv_contents;
		} else {
			return [];
		}
		
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
<?php
require_once 'model.php';
class ClassModel extends Model{
	private $conn;
	public function __construct(){
		parent::__construct("tblclass");
		$this->conn = $this->getDbConnection();
	}

	public function add_class($data){
		$this->authentication();
		$response = $this->insert($data);

		return $response;
	}

	public function update_class($data){
		$this->authentication();
		$conditions = array("class_id" => $data['class_id']);
		unset($data['class_id']);
		$response = $this->update($data, $conditions);
		return $response;
	}

	public function delete_class($data){
		$conditions = array("class_id" => $data['class_id']);
		$this->authentication();
		$response = $this->delete($conditions);
		return $response;
	}

	public function get_class_year($data){
		$conditions = array(
			"condition" => array(
				"tblclass" => array(
					"data" => array("yearlevel_id" => $data['yearlevel_id']),
					"operator" => ""
				)
			)
		);

		$this->authentication();
		$response = $this->select_one($conditions);
		return $response;
	}

	public function get_classes(){
		$conditions = array(
			"table" => array("yearlevel")
		);
		$this->authentication();
		return $this->select_all_joins("inner", $conditions);
	}
}
?>
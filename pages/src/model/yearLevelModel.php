<?php
require_once 'model.php';
class YearLevelModel extends Model {
	private $conn;
	public function __construct(){
		parent::__construct("tblyearlevel");
		$this->conn = $this->getDbConnection();
	}
	public function addYearLevel($data){
		$this->authentication();
		$response = $this->insert($data);
		return $response;
	}
	public function getYearLevels(){
		$this->authentication();
		$response = $this->select_all();
		return $response;
	}
	public function update_year_level($data){
		$this->authentication();
		$conditions = array(
			"yearlevel_id" => $data['yearlevel_id']
		);
		unset($data['yearlevel_id']);
		$response = $this->update($data, $conditions);
		return $response;
	}
	public function delete_year_level($data){
		$this->authentication();
		$conditions = array("yearlevel_id" => $data['yearlevel_id']);
		$response = $this->delete($conditions);
		return $response;
	}
}
?>
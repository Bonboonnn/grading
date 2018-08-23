<?php
require_once "config/config.php";

class SubjectModel extends Model {

	private $conn;

	public function __construct() {
		parent::__construct("tblsubject");
		$this->conn = $this->getDbConnection();
	}

	public function add_subject($data) {
		$this->authentication();
		$response = $this->insert($data);
		return $response;
	}

	public function update_subject($data) {
		$this->authentication();
		$conditions = array(
			"subject_id" => $data['subject_id']
		);
		unset($data['subject_id']);
		$response = $this->update($data, $conditions);
		return $response;
	}

	public function delete_subject($data) {
		$this->authentication();
		$conditions = array(
			"subject_id" => $data['subject_id']
		);
		$response = $this->delete($conditions);
		return $response;
	}

	public function get_subjects() {
		$this->authentication();
		$conditions = array(
			"table" => array("yearlevel", "schoolyear")
		);

		$response = $this->select_all_joins("inner", $conditions);
		return $response;
	}

}
?>
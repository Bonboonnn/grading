<?php
require_once 'config/config.php';
class Model extends Config{
	private $table;
	private $conn;
	private $placeholder = array();
	private $columns = array();
	private $values = array();
	private $bind = array();
	private $params = array();
	private $references = array();
	private $results = array();
	private $condition = array();
	public function __construct($table){
		parent::__construct();
		$this->table = $table;
		$this->conn = $this->connection();
	}
	public function getDbConnection(){
		return $this->connection();
	}

	public function select_all(){
		$sql = "SELECT * FROM ".$this->table;
		$query = mysqli_query($this->conn, $sql);
		$response = mysqli_fetch_all($query, MYSQLI_ASSOC);
		$query->close();
		return $response;
	}

	public function insert($data){
		foreach($data as $key => $val){
			$this->placeholder[] = '?';
			$this->columns[] = '`'.$key.'`';
			$this->values[] = $val;
		}

		foreach($this->values as $value){
			$type = gettype($value);
			if($type == "string"){
				$this->bind[] = "s";
			} else if($type == "integer") {
				$this->bind[] = "i";
			} else if($type == "double") {
				$this->bind[] = "d";
 			}
 			$this->params[] = $value;
		}

		array_unshift($this->params, join("", $this->bind));
		foreach($this->params as $key => $val){
			 $this->references[$key] = &$this->params[$key];
		}

		$sql = "INSERT INTO ".$this->table." (".join(',', $this->columns).") VALUES (".join(',', $this->placeholder).")";
		$query = $this->conn->prepare($sql) or die(mysqli_error($this->conn));
		call_user_func_array(array($query, "bind_param"), $this->references);
		if($query->execute()){
			$response = $this->response("success", "Data Saved");
		} else {
			$response = $this->response("error", "Failed to Save Data");
		}
		$query->close();
		$this->clean();
		return $response;
	}

	public function update($data, $conditions){
		foreach($data as $key => $value){
			$this->placeholder[] = '`'.$key.'`'." = ?";
			$this->values[] = $value;
		}

		foreach($conditions as $key => $value){
			$this->condition[] = $key." = ?";
			$this->values[] = $value;
		}

		foreach($this->values as $value){
			$type = gettype($value);
			if($type == "string"){
				$this->bind[] = "s";
			} else if($type == "integer") {
				$this->bind[] = "i";
			} else if($type == "double") {
				$this->bind[] = "d";
 			}
 			$this->params[] = $value;
		}

		array_unshift($this->params, join("", $this->bind));
		foreach($this->params as $key => $val){
			 $this->references[$key] = &$this->params[$key];
		}

		$sql = "UPDATE ".$this->table." SET ".join(', ', $this->placeholder)." WHERE ".join(', ', $this->condition);
		$query = $this->conn->prepare($sql);
		call_user_func_array(array($query, "bind_param"), $this->references);
		if($query->execute()){
			$response = $this->response("success", "Data Updated");
		} else {
			$response = $this->response("error", "Failed to Update Data");
		}
		$query->close();
		$this->clean();
		return $response;
	}

	public function delete($conditions) {
		foreach($conditions as $key => $value){
			$this->condition[] = $key." = ?";
			$this->values[] = $value;
		}
		foreach($this->values as $value) {
			$type = gettype($value);
			if($type == "string") {
				$this->bind[] = "s";
			} else if($type == "integer") {
				$this->bind[] = "i";
			} else if($type == "double") {
				$this->bind[] = "d";
 			}
 			$this->params[] = $value;
		}

		array_unshift($this->params, join("", $this->bind));
		foreach($this->params as $key => $val){
			 $this->references[$key] = &$this->params[$key];
		}

		$sql = "DELETE FROM ".$this->table." WHERE ".join(", ", $this->condition);
		$query = $this->conn->prepare($sql) or die(mysqli_error($this->conn));
		call_user_func_array(array($query, "bind_param"), $this->references);
		if($query->execute()){
			$response = $this->response("success", "Data Deleted");
		} else {
			$response = $this->response("error", "Failed to Delete Data");
		}
		return $response;
	}

	public function select_all_joins($type, $conditions) {
		$count = 0;
		$joins = array();
		foreach($conditions['table'] as $key => $val){
			$this->columns[] = $val."."."*";
			$joins[] = $type." join tbl".$val." as ".$val." on ".$val.".".$val."_id = ".$this->table.".".$val."_id";
		}
		$sql = "SELECT ".join(', ', $this->columns)." , ".$this->table.".* from ".$this->table." as ".$this->table." ".join(" ", $joins);
		$query = mysqli_query($this->conn, $sql);
		$response = mysqli_fetch_all($query, MYSQLI_ASSOC);
		$query->close();
		$this->clean();
		return $response;
	}	

	public function response($status, $message){
		return array(
			"status" => $status,
			"message" => $message
		);
	}

	private function clean(){
		$this->placeholder = array();
		$this->columns = array();
		$this->values = array();
		$this->bind = array();
		$this->params = array();
		$this->references = array();
		$this->results = array();
		$this->condition = array();
	}

	public function authentication(){
		if(isset($_SESSION['user_data']) && !empty($_SESSION['user_data']) ){
			$_SESSION['access'] = GRANTED;
		} else {
			$_SESSION['access'] = DENIED;
		}
	}
}
?>
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
	private $joins = array();
	public function __construct($table){
		parent::__construct();
		$this->table = $table;
		$this->conn = $this->connection();
	}
	public function getDbConnection(){
		return $this->connection();
	}

	public function raw_query($sql, $conditions = null) {
		if(isset($conditions) && !empty($conditions)){

			foreach($conditions as $key => $val){
				$this->placeholder[] = '`'.$this->table.'`.`'.$key.'` = ?';
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

			$sql = $sql." ".join(" ", $this->placeholder);
			$query = $this->conn->prepare($sql);
			call_user_func_array(array($query, "bind_param"), $this->references);
			$query->execute();
			$result = $query->get_result();
			$rows = $result->fetch_all(MYSQLI_ASSOC);

		} else {
			$query = mysqli_query($sql);
			$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
		}
		$query->close();
		$this->clean();
		return $rows;
	}

	public function select_all(){
		$sql = "SELECT * FROM ".$this->table;
		$query = mysqli_query($this->conn, $sql);
		$response = mysqli_fetch_all($query, MYSQLI_ASSOC);
		$query->close();
		$this->clean();
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
			$response = $this->response("error", "Failed to Save Data", $query->error);
		}
		$query->close();
		$this->clean();
		return $response;
	}

	public function select_joins($conditions) {
		$count = 0;
		$where = "";
		foreach($conditions['joins'] as $key => $value) {

			if(!empty($key)) {
				$this->joins[] = $conditions['type'][$count].' join tbl'.$key.' as '.$key.' on '.$key.'.'.$key.'_id='.$this->table.'.'.$key.'_id ';
			}

			foreach($value as $val) {
				if(!empty($key)){
					$this->columns[] = $key.".".$val;
				} else {
					$this->columns[] = $this->table.'.'.$val;
				}
			}

			$count++;
		}
		
		$opt = "";
		if(isset($conditions['opt'])) {
			$opt = $conditions['opt'];
		}

		$count = 0;

		if(isset($conditions['condition']) && !empty($conditions['condition'])){

			foreach($conditions['condition'] as $key => $value) {
				$this->placeholder[] = $this->table.'.'.$key." = ? ".$conditions['clause'][$count];
				$this->values[] = $value;
				$count++;
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
			
			$sql = "SELECT ".$opt.' '.join(" , ", $this->columns)." FROM ".$this->table." as ".$this->table.' '.join(" ", $this->joins).' WHERE '.join(' ', $this->placeholder);
			$query = $this->conn->prepare($sql) or die(mysqli_error($this->conn));
			call_user_func_array(array($query, "bind_param"), $this->references);
			$query->execute();
			$result = $query->get_result();
			$rows = $result->fetch_all(MYSQLI_ASSOC);

		} else {
			$sql = "SELECT ".$opt.' '.join(" , ", $this->columns)." FROM ".$this->table." as ".$this->table.' '.join(' ', $this->joins);
			$query = mysqli_query($this->conn, $sql);
			$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);

		}
		$query->close();
		$this->clean();
		return $rows;
	}

	public function select_where_one($conditions, $columns) {
		foreach($columns['columns'] as $column) {
			$this->columns[] = $column;
		}
		foreach($conditions['conditions'] as $key => $value){
			$this->placeholder[] = $key." = ?";
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
		$sql = "select ".join(', ', $this->columns)." from ".$this->table." where ".join(', ', $this->placeholder).' '.join('', $this->condition);
		$query = $this->conn->prepare($sql);
		call_user_func_array(array($query, "bind_param"), $this->references);
		$query->execute();
		$result = $query->get_result();
		$row = $result->fetch_all(MYSQLI_ASSOC);
		$this->clean();
		return $row;
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
			$response = $this->response("error", "Failed to Update Data", $query->error);
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
			$response = $this->response("success", "Record Deleted");
		} else {
			$response = $this->response("error", "Failed to delete record. Another data depends on this record", $query->error);
		}
		$query->close();
		$this->clean();
		return $response;
	}

	public function select_all_joins($type, $conditions) {
		$count = 0;
		
		foreach($conditions['table'] as $key => $val){
			$this->columns[] = $val."."."*";
			$this->joins[] = $type." join tbl".$val." as ".$val." on ".$val.".".$val."_id = ".$this->table.".".$val."_id";
		}
		$sql = "SELECT ".join(', ', $this->columns)." , ".$this->table.".* from ".$this->table." as ".$this->table." ".join(" ", $this->joins);
		$query = mysqli_query($this->conn, $sql);
		$response = mysqli_fetch_all($query, MYSQLI_ASSOC);
		$query->close();
		$this->clean();
		return $response;
	}	

	public function select_one($conditions) {
		foreach($conditions['condition'] as $key => $val) { 
			foreach($val['data'] as $k => $v){
				mysqli_real_escape_string($this->conn, $v);
				if(isset($val['operator'])){
					$this->condition[] = " ".$val['operator'].' `'.$key.'`.'.$k." = '".$v."'";
				} else {
					$this->condition[] = ' `'.$key.'`.'.$k." = '".$v."'";
				}
			}
		}
		if(isset($conditions['joins'])){
			foreach($conditions['joins'] as $key => $val){
				foreach($val as $k => $v){
					$this->columns[] = $v.".* , ";
					$this->joins[] = $k." join tbl".$v." as ".$v." on ".$v.".".$v."_id = ".$this->table.".".$v."_id";
				}
			}
		}
		$sql = "SELECT ".join(', ', $this->columns).$this->table.".* from ".$this->table." as ".$this->table." ".join(" ", $this->joins)." WHERE ".join(" ", $this->condition);
		$query = mysqli_query($this->conn, $sql);
		$response = mysqli_fetch_all($query, MYSQLI_ASSOC);
		$query->close();
		$this->clean();
		return $response;
	}

	public function response($status, $message, $error_type = ""){
		return array(
			"status" => $status,
			"message" => $message,
			"error" => $error_type
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
		$this->joins = array();
	}

	public function backup(){
		$this->authentication();
		$db_name = "grading_db";
		$mkdir = "mkdir C:\db_bak";
		$dir = "C:\\";
		$path = "db_bak/";
		exec($mkdir);
		$backup_file = $dir.$path.$db_name . date("Y-m-d") . '.sql';
		$command = 'mysqldump --user=root --password= --host=localhost grading_db > '.$backup_file;
		$output = array();
		exec($command, $output, $stat);
		switch($stat){
			case 0:
				$response = $this->response("success", "Database ".$db_name." backup successfull, to browse the file please go to ".$backup_file);
				break;
			default:
				$response = $this->response("error", "Database ".$db_name." Failed to backup");
				break;
		}
		return $response;
	}

	public function restore($data){
		$this->authentication();
		$db_name = "grading_db";
		$server_name = "localhost";
		$username = "root";
		$password = "";
		$file = $data["file"];
		$command = "mysql --host={$server_name} --user={$username} --password={$password} {$db_name} < $file";
		exec($command, $output, $stat);
		switch($stat){
			case 0:
				$response = $this->response("success", "Database ".$db_name." restored");
				break;
			default:
				$response = $this->response("error", "Failed to restore ".$db_name);
		}
		return $response;
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
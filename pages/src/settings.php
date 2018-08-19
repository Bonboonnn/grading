<?php
class Setting{
	private $_url = array();
	private $_methods = array();
	public function url($uri, $method = null){
		$this->_url[] = '/'.trim($uri, '/');
		if($method != null){
			$this->_methods[] = $method;
		}
	}
	public function run(){
		$url_param = isset($_GET['url']) ? '/'. $_GET['url'] : '/';
		foreach($this->_url as $key => $value){
			if(preg_match("#^$value$#", $url_param)){
				call_user_func($this->_methods[$key]);
			}
		}
	}
}
?>
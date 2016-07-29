<?php

class model_Session {

	private $table;

 	public function __construct(){
		new WASD();

		$this->table = C('app.db_prefix').'session';

		if(C('app.installed') == '1'){
			session_set_save_handler(
			    array($this, "_open"),
			    array($this, "_close"),
			    array($this, "_read"),
			    array($this, "_write"),
			    array($this, "_destroy"),
			    array($this, "_gc")
			);
		}
		 
		session_start();
	}


	public function _open(){
		if(C('app.db_name') != '')   return true;
		return false;
	}

	public function _close(){
		if(C('app.db_name') != '')   return true;
		return false;
	}

	public function _read($id){
	  // Set query
	  $row = WASD::$sql->select($this->table, array('access','data'), array('sessionId'=>$id));
	  if(count($row) >= 1){
	    return $row['0']['data'];

	  }else{
	    return '';
	  }
	}

	public function _write($id, $data){
	  $access = time();
	  $row = WASD::$sql->query("REPLACE INTO ".$this->table." (sessionId, access, data) VALUES ('$id', '$access', '$data')");
	  return true;
	}

	public function _destroy($id){
	  $row = WASD::$sql->delete($this->table, array('sessionId'=>$id));
	  if($row >= 1){
	    return true;
	  }
	  return false;
	} 

	public function _gc($max){
	  $old = time() - $max;
	  $row = WASD::$sql->delete($this->table, array('access[<]'=>$old));

	  if($row >= 1){
	    return true;
	  }
	  return false;
	}

}
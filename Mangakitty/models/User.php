<?php

class model_User {
	
	public $id;
	public $username;
	public $email;
	private $password;
	public $role;
	public $permissions;
	public $confirmedEmail;
	public $preferences;
	public $joinDate;
	public $lastActionTime;

	protected $errors = array();

	protected $table;
	
	protected $primaryKey;

	public $roles = array();

	public function __construct(){
		// CALL WASD MASTER CONTROLLERS SO IT WILL REGISTER OUR SQL INFORMATION
		$this->table = C('app.db_prefix').'user';
		$this->primaryKey = "userId";
		new WASD();
		// LOAD ALL ROLES INFO
		$this->getRoles();
	}

	public function getRoles(){
		$roles = WASD::$sql->select(C('app.db_prefix').'user_role', array("roleId","roleName","permissions"));
		foreach($roles as &$role){
			$this->roles[$role['roleId']]['name'] = $role['roleName'];
			$this->roles[$role['roleId']]['permissions'] = json_decode($role['permissions'], true);
		}
		return $this->roles;
	}


	public function role($role){
		return $this->roles[$role]['name'];
	}

	public function get($wheres = array()){
		$roleDb = C('app.db_prefix').'user_role';
		$user = WASD::$sql->select($this->table, 
			array("[>]".$roleDb => array("role" => "roleId")),
			array("userId","username","email","password","role",$roldDb.".roleName(roleName)",$roldDb.".permissions(permissions)","confirmedEmail","preferences","joinDate","lastActionTime"), 
			$wheres);
		if(count($user) == '0'){
			return false;
		}else if(count($user) == '1'){
			$this->id = $user['0']['userId'];
			$this->username = $user['0']['username'];
			$this->email = $user['0']['email'];
			$this->password = $user['0']['password'];
			$this->role = $user['0']['roleName'];
			$this->permissions = json_decode($user['0']['permissions'], true);
			$this->confirmedEmail = $user['0']['confirmedEmail'];
			$this->preferences = json_decode($user['0']['preferences'], true);
			$this->joinDate = $user['0']['joinDate'];
			$this->lastActionTime = $user['0']['lastActionTime'];

			$user[0]['permissions'] = json_decode($user[0]['permissions'], true);
			$user[0]['preferences'] = json_decode($user[0]['preferences'], true);
			
			return $user['0'];
		}else{	
			return $user; 
		}
	}

	public function search($wheres){
		$user = WASD::$sql->select($this->table, array("userId","username","email","password","role","confirmedEmail","preferences","joinDate","lastActionTime"), $wheres);
		return $user;
	}
	public function getBy($field, $value, $limit = NULL){
		$wheres = array($field=>$value);
		if($limit != NULL) $wheres = array_merge($wheres, array('LIMIT'=>$limit));
		$user = WASD::$sql->select($this->table, array("userId","username","email","password","role","confirmedEmail","preferences","joinDate","lastActionTime"), $wheres);
		if(count($user) == '1'){
			$this->id = $user['0']['userId'];
			$this->username = $user['0']['username'];
			$this->email = $user['0']['email'];
			$this->password = $user['0']['password'];
			$this->role = $this->roles[$user['0']['role']]['name'];
			$this->confirmedEmail = $user['0']['confirmedEmail'];
			$this->permissions = $this->roles[$user['0']['role']]['permissions'];
			$this->preferences = json_decode($user['0']['preferences'], true);
			$this->joinDate = $user['0']['joinDate'];
			$this->lastActionTime = $user['0']['lastActionTime'];
		}
		return $user;
	}	
	public function getByName($username){
		$wheres = array('username'=>$username,'LIMIT'=>'1');
		$user = WASD::$sql->select($this->table, array("userId","username","email","password","role","confirmedEmail","preferences","joinDate","lastActionTime"), $wheres);
		if(count($user) == '1'){
			$this->id = $user['0']['userId'];
			$this->username = $user['0']['username'];
			$this->email = $user['0']['email'];
			$this->password = $user['0']['password'];
			$this->role = $this->roles[$user['0']['role']]['name'];
			$this->permissions = $this->roles[$user['0']['role']]['permissions'];
			$this->confirmedEmail = $user['0']['confirmedEmail'];
			$this->preferences = json_decode($user['0']['preferences'], true);
			$this->joinDate = $user['0']['joinDate'];
			$this->lastActionTime = $user['0']['lastActionTime'];
			return $user['0'];
		}
	}	
	public function getByEmail($email){
		$wheres = array('email'=>$email,'LIMIT'=>'1');
		$user = WASD::$sql->select($this->table, array("userId","username","email","password","role","confirmedEmail","preferences","joinDate","lastActionTime"), $wheres);
		if(count($user) == '1'){
			$this->id = $user['0']['userId'];
			$this->username = $user['0']['username'];
			$this->email = $user['0']['email'];
			$this->password = $user['0']['password'];
			$this->role = $this->roles[$user['0']['role']]['name'];
			$this->permissions = $this->roles[$user['0']['role']]['permissions'];
			$this->confirmedEmail = $user['0']['confirmedEmail'];
			$this->preferences = json_decode($user['0']['preferences']);
			$this->joinDate = $user['0']['joinDate'];
			$this->lastActionTime = $user['0']['lastActionTime'];
		}
	}
	public function add(array $userInfo){
		$userInfo['joinDate'] = $userInfo['lastActionTime'] = time();
		$user = WASD::$sql->insert($this->table, $userInfo);
		return $user;
	}
	public function edit($userId, array $userInfo){
		$user = WASD::$sql->update($this->table, $userInfo, array('userId'=>$userId));
		return $user;
	}
	public function delete($field, $value){
		$delete = WASD::$sql->delete($this->table, array($field=>$value));
		return $delete;
	}
	public function addRole($name, array $permissions){
		$permissions = json_encode($permissions);
		$role = WASD::$sql->insert(C('app.db_prefix').'user_role', array('roleName'=>$name, 'permissions'=>$permissions));
		return $role;
	}
	public function updateRole($id, $name, array $permissions){
		$permissions = json_encode($permissions);
		$role = WASD::$sql->update(C('app.db_prefix').'user_role', array('roleName'=>$name, 'permissions'=>$permissions), array('roleId'=>$id));
		return $role;
	}
	public function deleteRole($id){
		$role = WASD::$sql->delete(C('app.db_prefix').'user_role', array('roleId'=>$id));
		return $role;
	}
	public function userList(array $wheres){
		$l = WASD::$sql->select($this->table, array("[>]".C('app.db_prefix')."user_role" => array("role" => "roleId")), array("userId","username","email","role","confirmedEmail","preferences","joinDate","joinIP","lastActionTime",C('app.db_prefix')."user_role.roleName(roleName)",C('app.db_prefix')."user_role.permissions(permissions)"), $wheres);
		return $l;
	}
	public function userCount(array $wheres){
		$c = WASD::$sql->count($this->table, $wheres);
		return $c;
	}
	public function validateUserName($username){
		if(preg_match(C('app.usernameRegex'), $username)) return true; 
		return false;
	}
}
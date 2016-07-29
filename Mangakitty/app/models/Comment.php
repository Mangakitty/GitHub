<?php 

	class Comment{

		private static $_instance = null;
		public static $table = 'comment';
		public static $field = '*';
		public static $single;
		public static $list;

		private function __construct () { 
	  		self::getInstance();
	    }

	    public static function getInstance (){
	        if (self::$_instance === null) {
	            self::$_instance = new self;
	        }

	        return self::$_instance;
	    }

		public static function field($f){
			self::$field = $f;
			return __CLASS__;
		}

		public static function count($a = ''){
			return WASD::$sql->count(C('app.db_prefix').self::$table, $a);
		}

		public static function find($a = ''){
			self::$list = WASD::$sql->select(C('app.db_prefix').self::$table, self::$field, $a);
			self::$field = '*';
			foreach (self::$list as &$single)
				$return[] = event('render_comment', $single);
			return $return;
		}

		public static function findFirst($a = ''){
			$result = WASD::$sql->select(C('app.db_prefix').self::$table, self::$field, $a);	
			self::$field = '*';		
			self::$single  = event('render_comment', $result[0]);
			return self::$single;
		}

		public static function isExist($a = ''){
			Comment::findFirst($a);
			if(!is_array(self::$single)) return false;
			return true;
		}

		public static function add($a){
			$a = event('do_comment_info', $a);
			if($a['chapter'] != '')
				$query1 = WASD::$sql->update(C('app.db_prefix').'chapter', array('comments[+]'=>'1'),
										array('AND'=>array('manga'=>$a['manga'], 'chapter'=>$a['chapter'])));
			
				$query1 = WASD::$sql->update(C('app.db_prefix').'manga', array('comments[+]'=>'1'),
										array('AND'=>array('mangaId'=>$a['manga'])));

			return WASD::$sql->insert(C('app.db_prefix').self::$table, $a);
		}

	} 


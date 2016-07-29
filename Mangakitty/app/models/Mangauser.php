<?php 

	class Mangauser{

		public static $table = 'user';
		public static $field = '*';
		public static $single;
		public static $list;

		public static function field($f){
			self::$field = $f;
			return self;
		}

		public static function count($a = ''){
			return WASD::$sql->count(C('app.db_prefix').self::$table, $a);
		}

		public static function find($a = ''){
			self::$list = WASD::$sql->select(C('app.db_prefix').self::$table, self::$field, $a);
			foreach (self::$list as &$single)
				$return[] = event('user_out', $single);
			return $return;
		}

		public static function findFirst($a = ''){
			$result = WASD::$sql->select(C('app.db_prefix').self::$table, self::$field, $a);			
			self::$single  = event('user_out', $result[0]);
			return self::$single;
		}

		public static function isExist($a = ''){
			Comment::findFirst($a);
			if(!is_array(self::$single)) return false;
			return true;
		}

		public static function add($a){
			$a = event('user_in', $a);
			return WASD::$sql->insert(C('app.db_prefix').self::$table, $a);
		}

	} 


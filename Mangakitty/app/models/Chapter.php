<?php 

	class Chapter{

		public static $table = 'chapter';
		public static $field = '*';
		public static $single;
		public static $list;

		public static function find($a = ''){
			self::$list = WASD::$sql->select(C('app.db_prefix').self::$table, self::$field, $a);
			return self::$list;
		}

		public static function findFirstById($a){
			$result = WASD::$sql->select(C('app.db_prefix').self::$table, self::$field, array(self::$table.'id'=>$a, 'LIMIT'=>'1'));
			self::$single  = $result[0];
			return self::$single;
		}

		public static function findFirst($a = ''){
			$result = WASD::$sql->select(C('app.db_prefix').self::$table, self::$field, $a);			
			self::$single  = $result[0];
			return self::$single;
		}

		public static function isExist($a = ''){
			return Chapter::findFirst($a);	
		}
		
		public static function isExistById($a){
			Comment::findFirstById($a);
			if(!is_array(self::$single)) return false;
			return true;
		}


	} 


<?php 
	
	if (!defined("_WASD_")) exit;

	class Template { 

		private $vars = array(); 

		public function __get($name) { return $this->vars[$name]; } 

		public function __set($name, $value) { 
			if($name == 'view_template_file') { 
				throw new Exception("Cannot bind variable named 'view_template_file'"); 
			} 
			if($name == 'noty'){ 
				$this->vars['noty'][] = $value; 
			}else{
				$this->vars[$name] = $value; 
			}
		}

		public function __isset($name) { return isset($this->vars[$name]); }

		public function render($view_template_file) { 
			if(array_key_exists('view_template_file', $this->vars)) { 
				throw new Exception("Cannot bind variable called 'view_template_file'"); }

			 	extract($this->vars);
			 	ob_start();
			 	if($view_template_file[0] == '/'){
			 		if(file_exists($file = ROOT_DIR . $view_template_file)){
				 		include($file);
				 	}else{
				 		error(T('View') . ' '. $file.' '. T('not found'));
				 	}
			 	}else{
			 		if(file_exists($file = THEMES_DIR . '/'. C('app.theme') .'/'.  $view_template_file)){
			 			include($file);
			 		}else if(file_exists($file = VIEWS_DIR . '/'.  $view_template_file)){
			 			include($file);
			 		}else{
				 		error(T('View') . ' '. $file.' '. T('not found'));
			 		}
				}
			return ob_get_clean(); 
		}

		public function addJSFile($file){
			$key = "local";
			if (strpos($file, "://") !== false) $key = "remote";
			$this->vars['jsFiles'][$key][] = $file;
		}

		public function addCSSFile($file){
			$key = "local";
			if (strpos($file, "://") !== false) $key = "remote";
			$this->vars['cssFiles'][$key][] = $file;
		}

	}
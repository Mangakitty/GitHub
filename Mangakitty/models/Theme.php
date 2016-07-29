<?php

class model_Theme {
	
	public $themes = array();

	public function __construct(){
		new WASD();
		// GET PLUGINS LIST
		$this->getThemesList();
	}

	public function getThemesList(){
		if ($handle = opendir(THEMES_DIR)) {
		    while (false !== ($entry = readdir($handle))) {
		        if ($entry != "." && $entry != "..") {
		            if(file_exists($file = THEMES_DIR . '/' . $entry . '/info.php' )){
    		            include $file;
    		            $this->themes[$entry] = $info;
    		        }
		        }
		    }
		    closedir($handle);
		}
	}

	// SHORTCUT OF $Themes->themes['name']
	public function get($themeName){
		return $this->themes[$themeName];
	}
	public function all(){
		return $this->themes;
	}

}
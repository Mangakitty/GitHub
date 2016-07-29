<?php

class model_Plugin {
	
	public $plugins = array();
	public $enabledPlugins = array();

	public function __construct(){
		new WASD();
		// GET PLUGINS LIST
		$this->getPluginsList();
	}

	public function getPluginsList(){
		if ($handle = opendir(PLUGINS_DIR)) {
		    while (false !== ($entry = readdir($handle))) {
		        if ($entry != "." && $entry != "..") {
		            if(file_exists($file = PLUGINS_DIR . '/' . $entry . '/info.php' )){
    		            include $file;
    		            $this->plugins[$entry] = $info;
    		            if(C("installed.".$entry) == '1') $this->plugins[$entry]['installed'] = '1'; 
    		        }
		        }
		    }
		    closedir($handle);
		}
		$this->enabledPlugins = C("app.enabledPlugins");
	}

	// SHORTCUT OF $Plugins->plugins['name']
	public function get($pluginName){
		return $this->plugins[$pluginName];
	}
	public function all(){
		return $this->plugins;
	}

}
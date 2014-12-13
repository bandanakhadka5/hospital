<?php

include_once('Exceptions.php');

class WhoDiseases extends BaseModel {

	/* Table Name */
	static $table_name = 'who_diseases';

    /*getter function */

    public function get_name(){

        return $this->read_attribute('name');

    }

    /*setter function */

    public function set_name($name){

        if(self::exists(array('name' => $name))) { 
            throw new Exception('The name entered already exists.'); 
        }

        $this->assign_attribute('name', $name);

    }

	/* Public static functions */

	public static function create($name) {

        $disease = new WhoDiseases();

        $disease->name = $name;

		return $disease;
	}

}

?>
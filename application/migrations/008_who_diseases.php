<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Who_diseases extends CI_Migration {

	public function up() {

		$fields = array(
		
			'id' => array(
				'type' => 'int',
				'auto_increment' => true,
			),

			'name' => array(
				'type' => 'varchar',				
				'constraint'=>'250',
			)
			
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('who_diseases');

	}

	public function down() {

		$this->dbforge->drop_table('who_diseases');

	}
}
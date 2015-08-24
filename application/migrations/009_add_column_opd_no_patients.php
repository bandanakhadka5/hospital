<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_column_opd_no_patients extends CI_Migration {

	public function up() {
		
		$field = array(			

			'opd_no' => array(
				'type' => 'varchar',
				'constraint' => 45,
			),
		);

		$this->dbforge->add_column('patients',$field);

	}

	public function down() {
		
		$this->dbforge->drop_column('patients','opd_no');
	}

}
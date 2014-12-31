<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_diagnosis extends CI_Migration {

	public function up() {

		$fields = array(
		
			'id' => array(
				'type' => 'int',
				'auto_increment' => true,
			),

			'patient_id' => array(
				'type' => 'int',
			),

			'diagnosis' => array(
				'type' => 'varchar',
				'constraint'=>'250',
			),

			'medication' => array(
				'type' => 'varchar',
				'constraint'=>'250',
			),

			'med_remarks' => array(
				'type' => 'varchar',
				'constraint'=>'250',
			),

			'details' => array(
				'type' => 'varchar',
				'constraint'=>'500',
			),

			'doctor' => array(
				'type' => 'varchar',
				'constraint'=>'250',
				'null' => False,
			),

			'consultation_type' => array(
				'type' => 'varchar',
				'constraint'=>'250',
				'null' => False,
			),

			'type_id' => array(
				'type' => 'int',
				'null'=>False,
			),

			'active' => array(
				'type' => 'boolean',
				'default' => 1,
			),

			'deleted' => array(
				'type'=>'boolean',
				'default'=> 0,
			),

			'created_at' => array(
				'type' => 'timestamp',
			),

			'modified_at' => array(
				'type' => 'timestamp',
			),
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table('diagnosis');

		$this->db->query('ALTER TABLE diagnosis MODIFY modified_at TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
	}

	public function down() {
		$this->dbforge->drop_table('diagnosis');
	}
}
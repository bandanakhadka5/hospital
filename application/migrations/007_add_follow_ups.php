<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_follow_ups extends CI_Migration {

	public function up() {

		$fields = array(
		
			'id' => array(
				'type' => 'int',
				'auto_increment' => true,
			),

			'patient_id' => array(
				'type' => 'int',
			),

			'follow_up_date' => array(
				'type' => 'datetime',
				'null' => False,
			),

			'doctor' => array(
				'type' => 'varchar',
				'constraint'=>'250',
				'null' => False,
			),

			'consultation_type' => array(
				'type' => 'varchar',
				'constraint'=>'250',
				'null' => TRUE,
			),

			'type_id' => array(
				'type' => 'int',
				'null'=>TRUE,
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
		$this->dbforge->create_table('patient_follow_ups');

		$this->db->query('ALTER TABLE patient_follow_ups MODIFY modified_at TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');

	}

	public function down() {

		$this->dbforge->drop_table('patient_follow_ups');

	}
}
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_patients_opd extends CI_Migration {

	public function up() {

		$fields = array(
		
			'id' => array(
				'type' => 'int',
				'auto_increment' => true,
			),

			'patient_id' => array(
				'type' => 'int',
			),

			'date_of_consultation' => array(
				'type' => 'datetime',
			),

			'chief_compliants'=> array(
				'type'=> 'varchar',
				'constraint'=>'250',
				'null'=>True,
			),

			'doctor'=> array(
				'type'=>'varchar',
				'constraint'=>'250',
				'null'=>True,
			),

			'active' => array(
				'type' => 'boolean',
				'default' => True,
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
		$this->dbforge->create_table('patients_opd');

		//$this->db->query('ALTER TABLE patients_opd MODIFY modified_at TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');

	}

	public function down() {

		$this->dbforge->drop_table('patients_opd');

	}
}
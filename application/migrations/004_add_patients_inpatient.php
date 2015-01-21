<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_patients_inpatient extends CI_Migration {

	public function up() {

		$fields = array(
		
			'id' => array(
				'type' => 'int',
				'auto_increment' => true,
			),

			'patient_id' => array(
				'type' => 'int',
			),

			'date_of_admission' => array(
				'type' => 'datetime',
			),

			'date_of_procedure' => array(
				'type' => 'datetime',
				'null'=>True,
			),

			'date_of_discharge' => array(
				'type' => 'datetime',
				'null'=>True,
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
		$this->dbforge->create_table('patients_inpatient');

		//$this->db->query('ALTER TABLE patients_inpatient MODIFY modified_at TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');

	}

	public function down() {

		$this->dbforge->drop_table('patients_inpatient');

	}
}
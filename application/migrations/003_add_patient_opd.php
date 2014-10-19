<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_patient_opd extends CI_Migration {

	public function up() {
		$fields = array(
			'ID' => array(
				'type' => 'int',
				'auto_increment' => true,
			),
			'PatientID' => array(
				'type' => 'int',
			),
			'DateOfConsultation' => array(
				'type' => 'datetime',
				'null' => False,
			),
			'CreatedAt' => array(
				'type' => 'timestamp',
			),
			'ModifiedAt' => array(
				'type' => 'timestamp',
			),
			'ChiefCompliants'=> array(
				'type'=> 'varchar',
				'constraint'=>'250',
				'null'=>True,
			),
			'Doctor'=> array(
				'type'=>'varchar',
				'constraint'=>'250',
				'null'=>True,
			),
			'Active' => array(
				'type' => 'boolean',
				'default' => True,
			),

			'Deleted' => array(
				'type'=>'boolean',
				'default'=> 0,
			),
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('ID', true);
		$this->dbforge->create_table('patient_opd');

		$this->db->query('ALTER TABLE patient_opd MODIFY ModifiedAt TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');

	}

	public function down() {

		$this->dbforge->drop_table('patient_opd');

	}
}
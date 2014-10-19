<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_follow_up extends CI_Migration {

	public function up() {
		$fields = array(
			'ID' => array(
				'type' => 'int',
				'auto_increment' => true,
			),
			'PatientID' => array(
				'type' => 'int',
			),
			'FollowUpDate' => array(
				'type' => 'datetime',
				'null' => False,
			),
			'Doctor' => array(
				'type' => 'varchar',
				'constraint'=>'250',
				'null' => False,
			),
			'ConsultationType' => array(
				'type' => 'varchar',
				'constraint'=>'250',
				'null' => False,
			),

			'TypeId' => array(
				'type' => 'int',
				'null'=>False,
			),

			'CreatedAt' => array(
				'type' => 'datetime',
			),
			'ModifiedAt' => array(
				'type' => 'timestamp',
			),
			'Active' => array(
				'type' => 'boolean',
				'default' => 1,
			),

			'Deleted' => array(
				'type'=>'boolean',
				'default'=> 0,
			),
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('ID', true);
		$this->dbforge->create_table('patient_follow_up');

	}

	public function down() {

		$this->dbforge->drop_table('patient_follow_up');

	}
}
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_patient extends CI_Migration {

	public function up() {
		$fields = array(
			'ID' => array(
				'type' => 'int',
				'auto_increment' => true,
			),
			'PubID' => array(
				'type' => 'varchar',
				'constraint' => 45,
			),
			'CreatedAt' => array(
				'type' => 'timestamp',
			),
			'ModifiedAt' => array(
				'type' => 'timestamp',
			),

			'FirstName' => array(
				'type' => 'varchar',
				'constraint' => 45,
				'null' => False,
			),

			'MiddleName' => array(
				'type' => 'varchar',
				'constraint' => 45,
				'null' => True,
			),
			'LastName' => array(
				'type' => 'varchar',
				'constraint' => 45,
				'null' => False,
			),

			'Age' => array(
				'type' => 'int',
				'constraint' => 45,
				'null' => False,
			),
			'Sex' => array(
				'type' => 'boolean',				
				'null' => False,
			),

			'Address' => array(
				'type' => 'varchar',
				'constraint' => 45,
				'null' => True,
			),

			'DateOfBirth' => array(
				'type' => 'datetime',
				'null' => False,
			),
			'Email' => array(
				'type' => 'varchar',
				'constraint' => 256,
				'null' => true,
			),
			
			'SourceOfReferal' => array(
				'type' => 'varchar',
				'constraint' => 45,
				'null' => True,
			),
			'ContactPerson' => array(
				'type' => 'varchar',
				'constraint' => 45,
				'null' => True,
			),
			'RelationWithPatient' => array(
				'type' => 'varchar',
				'constraint' => 45,
				'null' => True,
			),
			'ContactNumber' => array(
				'type'=> 'varchar',
				'constraint' => 45,
				'null'=> True,
			),
			'Informant' => array(
				'type' => 'varchar',
				'constraint' => 45,
				'null' => True,
			),
			'LastVisitedAt' => array(
				'type' => 'datetime',
				'null' => true,
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
		$this->dbforge->create_table('hospital_patient');

		$this->db->query('ALTER TABLE hospital_patient MODIFY ModifiedAt TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
	}

	public function down() {
		$this->dbforge->drop_table('hospital_patient');
	}

}
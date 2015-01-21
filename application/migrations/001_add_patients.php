<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_patients extends CI_Migration {

	public function up() {

		$fields = array(

			'id' => array(
				'type' => 'int',
				'auto_increment' => true,
			),
			'pub_id' => array(
				'type' => 'varchar',
				'constraint' => 45,
			),

			'first_name' => array(
				'type' => 'varchar',
				'constraint' => 45,
				'null' => False,
			),

			'middle_name' => array(
				'type' => 'varchar',
				'constraint' => 45,
				'null' => True,
			),
			'last_name' => array(
				'type' => 'varchar',
				'constraint' => 45,
				'null' => False,
			),

			'age' => array(
				'type' => 'int',
				'constraint' => 45,
				'null' => False,
			),
			'sex' => array(
				'type' => 'boolean',				
				'null' => False,
			),

			'address' => array(
				'type' => 'varchar',
				'constraint' => 45,
				'null' => True,
			),

			'date_of_birth' => array(
				'type' => 'datetime',
				'null' => True,
			),

			'email' => array(
				'type' => 'varchar',
				'constraint' => 256,
				'null' => true,
			),
			
			'source_of_referal' => array(
				'type' => 'varchar',
				'constraint' => 45,
				'null' => True,
			),

			'contact_person' => array(
				'type' => 'varchar',
				'constraint' => 45,
				'null' => True,
			),

			'relation_with_patient' => array(
				'type' => 'varchar',
				'constraint' => 45,
				'null' => True,
			),

			'contact_number' => array(
				'type'=> 'varchar',
				'constraint' => 45,
				'null'=> True,
			),

			'informant' => array(
				'type' => 'varchar',
				'constraint' => 45,
				'null' => True,
			),

			'last_visited_at' => array(
				'type' => 'datetime',
				'null' => true,
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
		$this->dbforge->create_table('patients');

		//$this->db->query('ALTER TABLE patients MODIFY modified_at TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
	}

	public function down() {
		$this->dbforge->drop_table('patients');
	}

}
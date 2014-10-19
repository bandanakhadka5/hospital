<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_user extends CI_Migration {

	public function up() {
		$fields = array(
			'ID' => array(
				'type' => 'int',
				'auto_increment' => true,
			),
			'firstname' => array(
				'type' => 'varchar',				
				'constraint'=>'250'
			),
			'lastname' => array(
				'type' => 'varchar',				
				'constraint'=>'250'
			),
			'middlename' => array(
				'type' => 'varchar',				
				'constraint'=>'250',
				'null'=>False,
			),
			'username' => array(
				'type' => 'varchar',
				'constraint'=>'250',
				'null' => False,
			),
			'password' => array(
				'type' => 'varchar',
				'constraint' => 128,
				'null' => False,
			),
			'email' => array(
				'type' => 'varchar',
				'constraint'=>'250',
				'null' => True,
			),
			'CreatedAt' => array(
				'type' => 'timestamp',
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
		$this->dbforge->create_table('patient_user');

		$this->db->query('ALTER TABLE patient_user MODIFY ModifiedAt TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');

		$data =  array(
					'ID'=>1,
					'firstname' => 'admin',
					'middlename' => 'admin',
					'lastname' => 'admin',
					'username'=>'bgadmin',
					'password'=>'bghospital',
					'email' => 'admin@bghospital.com',

				);

		$this->db->insert('patient_user', $data);

	}

	public function down() {

		$this->dbforge->drop_table('patient_user');

	}
}
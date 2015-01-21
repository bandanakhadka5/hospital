<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_users extends CI_Migration {

	public function up() {

		$fields = array(
		
			'id' => array(
				'type' => 'int',
				'auto_increment' => true,
			),

			'first_name' => array(
				'type' => 'varchar',				
				'constraint'=>'250'
			),

			'last_name' => array(
				'type' => 'varchar',				
				'constraint'=>'250'
			),

			'middle_name' => array(
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
		$this->dbforge->create_table('users');

		//$this->db->query('ALTER TABLE users MODIFY modified_at TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');

		$data =  array(

					'id'=>1,
					'first_name' => 'admin',
					'middle_name' => 'admin',
					'last_name' => 'admin',
					'username'=>'bgadmin',
					'password'=>'bghospital',
					'email' => 'admin@bghospital.com',
				);

		$this->db->insert('users', $data);

	}

	public function down() {

		$this->dbforge->drop_table('users');

	}
}
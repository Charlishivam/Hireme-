<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsers extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'             => ['type' => 'varchar', 'constraint' => 255],
            'username'         => ['type' => 'varchar', 'constraint' => 30, 'null' => true],
            'email'            => ['type' => 'varchar', 'constraint' => 255],
            'mobile'            => ['type' => 'varchar', 'constraint' => 10],   
            'password'    	   => ['type' => 'varchar', 'constraint' => 72],
            'status'           => ['type' => 'varchar', 'constraint' => 15, 'null' => true, 'default' => 'DISABLE'],
            'user_type'        => ['type' => 'varchar', 'constraint' => 15, 'null' => true, 'default' => 'S'], 
            'profile_status'   => ['type' => 'int', 'constraint' => 4, 'default' => 1],
            'profile_data'     => ['type' => 'longtext', 'null' => true, 'default' => null],
            'thumbnail'     => ['type' => 'varchar', 'constraint' => 150, 'null' => true, 'default' => null],
            'created_at datetime default CURRENT_TIMESTAMP()',
            'updated_at datetime default NULL on update CURRENT_TIMESTAMP()',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('status');
        $this->forge->addKey('user_type');
        $this->forge->addUniqueKey('email');
        $this->forge->addUniqueKey('username');
        $this->forge->addUniqueKey('mobile');

        $this->forge->createTable('users', true);
	}

	public function down()
	{
		$this->forge->dropTable('users', true);
	}
}
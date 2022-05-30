<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tag extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'             => ['type' => 'varchar', 'constraint' => 100],
            'description'      => ['type' => 'varchar', 'constraint' => 200, 'null' => true],
            'status'           => ['type' => 'varchar', 'constraint' => 15, 'null' => true, 'default' => 'DISABLE'],
            'created_at datetime default CURRENT_TIMESTAMP()',
            'updated_at datetime default NULL on update CURRENT_TIMESTAMP()',
            
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('status');

        $this->forge->createTable('tag', true);
	}

	public function down()
	{
		$this->forge->dropTable('tag', true);
	}
}
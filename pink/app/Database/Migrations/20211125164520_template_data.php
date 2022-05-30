<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Templatedata extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'        => ['type' => 'varchar', 'constraint' => 255],
            'userid'      => ['type' => 'varchar', 'constraint' => 100, 'null' => true],
            'thumbnail'   => ['type' => 'varchar', 'constraint' => 200, 'null' => true, 'default' => null],
            'created_at datetime default CURRENT_TIMESTAMP()',
            'updated_at datetime default NULL on update CURRENT_TIMESTAMP()',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('template_data', true);
	}

	public function down()
	{
		$this->forge->dropTable('template_data', true);
	}
}
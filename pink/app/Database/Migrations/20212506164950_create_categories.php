<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCategories extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'             => ['type' => 'varchar', 'constraint' => 100],
            'slug'             => ['type' => 'varchar', 'constraint' => 100],
            'thumbnail'        => ['type' => 'varchar', 'constraint' => 150, 'null' => true],
            'description'      => ['type' => 'varchar', 'constraint' => 200, 'null' => true],
            'icon'             => ['type' => 'varchar', 'constraint' => 50, 'null' => true],
            'status'           => ['type' => 'varchar', 'constraint' => 15, 'null' => true, 'default' => 'DISABLE'],
            'type'             => ['type' => 'varchar', 'constraint' => 15, 'null' => true],
            'eventdate datetime default NULL',
            'startdate datetime default NULL',
            'enddate datetime default NULL',
            'created_at datetime default CURRENT_TIMESTAMP()',
            'updated_at datetime default NULL on update CURRENT_TIMESTAMP()',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('status');
        $this->forge->addKey('type');
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('categories', true);
	}

	public function down()
	{
		$this->forge->dropTable('categories', true);
	}
}
<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Template extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'             => ['type' => 'varchar', 'constraint' => 100],
            'slug'             => ['type' => 'varchar', 'constraint' => 100],
            'thumbnail'        => ['type' => 'varchar', 'constraint' => 150, 'null' => true, 'default' => null],
            'category_id'      => ['type' => 'int', 'constraint' => 11, 'null' => true, 'default' => null],
            'tag_id'           => ['type' => 'int', 'constraint' => 11, 'null' => true, 'default' => null],
            'description'      => ['type' => 'varchar', 'constraint' => 200, 'null' => true],
            'price'            => ['type' => 'varchar', 'constraint' => 50, 'null' => true],
            'discount'         => ['type' => 'varchar', 'constraint' => 50, 'null' => true],
            'icon'             => ['type' => 'varchar', 'constraint' => 50, 'null' => true],
            'status'           => ['type' => 'varchar', 'constraint' => 15, 'null' => true, 'default' => 'DISABLE'],
            'featured'         => ['type' => 'varchar', 'constraint' => 2, 'null' => true],
            'bestceller'       => ['type' => 'varchar', 'constraint' => 2, 'null' => true],
            'startdate datetime default NULL',
            'enddate datetime default NULL',
            'created_at datetime default CURRENT_TIMESTAMP()',
            'updated_at datetime default NULL on update CURRENT_TIMESTAMP()',
            
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('status');
        $this->forge->addUniqueKey('slug');
        $this->forge->addUniqueKey('category_id');
        $this->forge->addUniqueKey('tag_id');

        $this->forge->createTable('template', true);
	}

	public function down()
	{
		$this->forge->dropTable('template', true);
	}
}
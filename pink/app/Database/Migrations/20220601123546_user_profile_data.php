<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserProfile extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'int',     'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'          => ['type' => 'varchar', 'constraint' => 50],
            'email'         => ['type' => 'varchar', 'constraint' => 50],
            'mobile'        => ['type' => 'varchar', 'constraint' => 10],   
            'dob'           => ['type' => 'DATE',    'constraint' => 10],
            'gender'        => ['type' => 'varchar', 'constraint' => 5],
            'anniversary'   => ['type' => 'DATE',    'constraint' => 10], 
            'address'       => ['type' => 'varchar', 'constraint' => 200],
            'dob date("Y-m-d") default NULL',
            'anniversary date("Y-m-d") default NULL',
            'created_at datetime default CURRENT_TIMESTAMP()',
            'updated_at datetime default NULL on update CURRENT_TIMESTAMP()',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('email');
        $this->forge->addUniqueKey('mobile');

        $this->forge->createTable('user_profile', true);
    }

    public function down()
    {
        $this->forge->dropTable('user_profile', true);
    }
}
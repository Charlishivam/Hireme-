<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserCompanyProfile extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_email'       => ['type' => 'varchar', 'constraint' => 50],
            'company_name'     => ['type' => 'varchar', 'constraint' => 50],
            'company_email'    => ['type' => 'varchar', 'constraint' => 50],
            'company_mobile'   => ['type' => 'varchar', 'constraint' => 20],   
            'company_address'  => ['type' => 'varchar', 'constraint' => 200],
            'created_at datetime default CURRENT_TIMESTAMP()',
            'updated_at datetime default NULL on update CURRENT_TIMESTAMP()',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('user_email');
        $this->forge->addUniqueKey('company_email');
        $this->forge->addUniqueKey('company_mobile');

        $this->forge->createTable('user_company_profile', true);
	}

	public function down()
	{
		$this->forge->dropTable('user_company_profile', true);
	}
}
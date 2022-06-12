<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Profiles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'contact' => [
                'type' => 'TEXT',
            ],
            'full_name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'position' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'location' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'photo' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'summary' => [
                'type' => 'TEXT',
            ],
            'skills' => [
                'type' => 'TEXT',
            ],
            'work_experiece' => [
                'type' => 'TEXT',
            ],
            'portofolio' => [
                'type' => 'TEXT',
            ],
            'education' => [
                'type' => 'TEXT',
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'default' => null,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('profiles');
    }

    public function down()
    {
        $this->forge->dropTable('profiles');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mahasiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'pendidikan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'keahlian' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'telephone' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'pengalaman' => [
                'type' => 'TEXT',
            ],
            'image' => [
                'type' => 'TEXT',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'default' => null,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('mahasiswa');
    }

    public function down()
    {
        $this->forge->dropTable('mahasiswa');
    }
}

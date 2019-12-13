<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Alunos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'       => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'avatar'   => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'nome'     => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'endereco' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('alunos');
    }

    public function down()
    {
        $this->forge->dropTable('alunos');
    }
}

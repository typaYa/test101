<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Comments extends Migration
{
    public function up()
    {
        // Определяем структуру таблицы
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'text' => [
                'type' => 'TEXT',
            ],
            'date' => [
                'type' => 'DATE',
            ],
        ]);

        // Определяем первичный ключ
        $this->forge->addKey('id', true);

        // Создаем таблицу
        $this->forge->createTable('comments');
    }

    public function down()
    {
        // Удаляем таблицу
        $this->forge->dropTable('comments');
    }
}

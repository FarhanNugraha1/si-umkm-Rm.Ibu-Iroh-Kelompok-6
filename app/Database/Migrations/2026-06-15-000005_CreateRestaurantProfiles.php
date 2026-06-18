<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRestaurantProfiles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_restoran' => [
                'type'       => 'VARCHAR',
                'constraint' => 120,
                'default'    => 'RM. Ibu Iroh',
            ],
            'sejarah' => [
                'type' => 'TEXT',
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'jam_operasional' => [
                'type'       => 'VARCHAR',
                'constraint' => 120,
            ],
            'telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
            'whatsapp' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
            'map_embed_url' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'map_link' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('restaurant_profiles', true);
    }

    public function down()
    {
        $this->forge->dropTable('restaurant_profiles', true);
    }
}

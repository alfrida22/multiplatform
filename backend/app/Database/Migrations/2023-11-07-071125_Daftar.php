<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Daftar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id"=> [
                "type"=> "INT",
                "constraint"    => 11,
                "auto_increment"    => true
            ],
            
            "username"=> [
                "type"=> "VARCHAR",
                "constraint"    => 200,
            
            ],

            "email"=> [
                "type"=> "VARCHAR",
                "constraint"    => 200,
            ],

            "password"=> [
                "type"=> "CHAR",
                "constraint"    => 60,  
            ], 
        ]);   
        $this->forge->addkey('id', true);
        $this->forge->createTable('Daftar');
    }

    public function down()
    {
        //
    }
}
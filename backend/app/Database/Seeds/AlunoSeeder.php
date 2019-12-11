<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class AlunoSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $this->db->table('alunos')->insert([
                'nome'     => $faker->name,
                'endereco' => $faker->address,
            ]);
        }
    }
}

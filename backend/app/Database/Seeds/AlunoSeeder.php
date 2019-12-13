<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class AlunoSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 4; $i++) {
            $this->db->table('alunos')->insert([
                'avatar'     => $faker->imageUrl(),
                'nome'     => $faker->name,
                'endereco' => $faker->address,
            ]);
        }
    }
}

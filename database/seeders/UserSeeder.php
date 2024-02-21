<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        \App\Models\User::factory(20)->create();
        \App\Models\User::factory()->createMany([
            [
                'name' => 'richard',
                'email' => 'richard@example.com',
            ],
            [
                'name' => 'Emma',
                'email' => 'emma@example.com',
            ],
            [
                'name' => 'benji',
                'email' => 'benji@example.com',
            ],
            [
                'name' => 'mohamed',
                'email' => 'mohamed@example.com',
            ],
        ]);
    }
}

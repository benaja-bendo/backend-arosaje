<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listPlant = [
            [
                'name' => 'Banana',
                'description' => 'Banana is a tropical fruit that is grown in many countries around the world. It is a popular fruit that is eaten in many different ways. It is grown in many different countries around the world. It is a popular fruit that is eaten in many different ways. It is grown in many different countries around the world. It is a popular fruit that is eaten in many different ways. It is grown in many different countries around the world. It is a popular fruit that is eaten in many different ways.',
                'path_image' => 'https://media.istockphoto.com/id/1380361370/fr/photo/bananier-d%C3%A9coratif-en-vase-en-b%C3%A9ton-isol%C3%A9-sur-fond-blanc.jpg?s=612x612&w=0&k=20&c=Sbo0kQTPXca_yhal1n9KUAbXj1B9NNAXmDdPYMNUDDM=',
                'user_created' => 1,
                'date_begin' => '2021-01-01',
                'date_end' => '2021-12-31',
                'is_published' => true,
            ],
        ];

        \App\Models\Plant::factory()
            ->count(10)
            ->create([
                'path_image' => 'https://media.istockphoto.com/id/1380361370/fr/photo/bananier-d%C3%A9coratif-en-vase-en-b%C3%A9ton-isol%C3%A9-sur-fond-blanc.jpg?s=612x612&w=0&k=20&c=Sbo0kQTPXca_yhal1n9KUAbXj1B9NNAXmDdPYMNUDDM=',
            ]);
    }
}

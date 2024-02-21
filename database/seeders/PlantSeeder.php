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
                'name' => 'Monstera Deliciosa',
                'description' => "Une plante d'intérieur populaire avec des feuilles découpées et un aspect tropical.
Conseils d'entretien : Placez-la dans un endroit lumineux, arrosez régulièrement et fournissez un support pour qu'elle grimpe.",
                'path_image' => "https://lagreentouch.fr/cdn/shop/products/acheter-plante-monstera-deliciosa-et-son-cache-pot-dore-h80cm-o21cm-grande-plante-dinterieur-183522.png?v=1694056707&width=1214",
                'address' => fake()->address,
                'user_created' => fake()->randomElements([1, 2, 3, 4])[0],
                'date_begin' => '2024-03-01',
                'date_end' => '2024-03-31',
                'is_published' => fake()->boolean,
            ],
            [
                'name' => 'Succulente Echeveria',
                'description' => "Une succulente aux feuilles épaisses et charnues, souvent en forme de rosette.
Conseils d'entretien : Arrosez modérément, placez-la dans un endroit ensoleillé et utilisez un sol bien drainant.",
                'path_image' => "https://undergreen.be/wp-content/uploads/sites/3/2021/07/echeveria-756x756.png",
                'address' => fake()->address,
                'user_created' => fake()->randomElements([1, 2, 3, 4])[0],
                'date_begin' => '2024-03-01',
                'date_end' => '2024-03-31',
                'is_published' => fake()->boolean,
            ],
            [
                'name' => 'Fougère de Boston (Nephrolepis exaltata)',
                'description' => "Une fougère élégante avec des frondes plumeuses et légères.
Conseils d'entretien : Gardez le sol constamment humide, évitez la lumière directe du soleil, et augmentez l'humidité si possible.",
                'path_image' => "https://pousse.fr/cdn/shop/files/23_600x600_crop_center.png?v=1689259399",
                'address' => fake()->address,
                'user_created' => fake()->randomElements([1, 2, 3, 4])[0],
                'date_begin' => '2024-03-01',
                'date_end' => '2024-03-31',
                'is_published' => fake()->boolean,
            ],
            [
                'name' => 'Zèbre Haworthiopsis (Haworthiopsis attenuata)',
                'description' => "Une plante succulente compacte avec des feuilles vertes striées de motifs de zèbre.
Conseils d'entretien : Arrosez modérément, placez-la à la lumière indirecte, et utilisez un mélange de sol bien drainant.",
                'path_image' => "https://www.canopi-plants.com/_next/image?url=https%3A%2F%2Fcdn.shopify.com%2Fs%2Ffiles%2F1%2F0533%2F8526%2F5337%2Ffiles%2Fimage_099c492f-19a2-41ed-a634-b66d9f651a15.png%3Fv%3D1685821152&w=3840&q=75",
                'address' => fake()->address,
                'user_created' => fake()->randomElements([1, 2, 3, 4])[0],
                'date_begin' => '2024-03-01',
                'date_end' => '2024-03-31',
                'is_published' => fake()->boolean,
            ],
        ];

//        \App\Models\Plant::factory()
//            ->count(10)
//            ->create([
//                'path_image' => 'https://media.istockphoto.com/id/1380361370/fr/photo/bananier-d%C3%A9coratif-en-vase-en-b%C3%A9ton-isol%C3%A9-sur-fond-blanc.jpg?s=612x612&w=0&k=20&c=Sbo0kQTPXca_yhal1n9KUAbXj1B9NNAXmDdPYMNUDDM=',
//            ]);

        foreach ($listPlant as $plant) {
            \App\Models\Plant::create([
                'name' => $plant['name'],
                'description' => $plant['description'],
                'path_image' => $plant['path_image'],
                'address' => $plant['address'],
                'user_created' => $plant['user_created'],
                'date_begin' => $plant['date_begin'],
                'date_end' => $plant['date_end'],
                'is_published' => $plant['is_published'],
            ]);
        }
    }
}

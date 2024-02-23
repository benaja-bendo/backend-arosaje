<?php

namespace Database\Seeders;

use App\Models\Advice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'content' => "Arrosez régulièrement, mais laissez le sol sécher entre les arrosages."
            ],
            [
                'content' => "Placez-la dans un endroit ensoleillé et arrosez modérément."
            ],
            [

                'content' => "Gardez le sol constamment humide, évitez la lumière directe du soleil."
            ],
            [
                'content' => "Arrosez modérément, placez-la à la lumière indirecte."
            ],
            [
                'content' => "Arrosez régulièrement, mais laissez le sol sécher entre les arrosages."
            ],
            [
                'content' => "Placez-la dans un endroit ensoleillé et arrosez modérément."
            ],
            [
                'content' => "Gardez le sol constamment humide, évitez la lumière directe du soleil."
            ],
            [
                'content' => "Arrosez modérément, placez-la à la lumière indirecte."
            ],
            [
                'content' => "Arrosez régulièrement, mais laissez le sol sécher entre les arrosages."
            ],
            [
                'content' => "Placez-la dans un endroit ensoleillé et arrosez modérément."
            ],
        ];
//        Advice::factory()
//            ->count(10)
//            ->create();
        foreach ($datas as $data) {
            Advice::factory()->create($data);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Conversation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConversationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Conversation::factory()->createMany([
            [
                'created_by' => 1,
                'participant_id' => 2,
            ],
            [
                'created_by' => 1,
                'participant_id' => 3,
            ],
            [
                'created_by' => 1,
                'participant_id' => 4,
            ],
            [
                'created_by' => 2,
                'participant_id' => 3,
            ],
            [
                'created_by' => 2,
                'participant_id' => 4,
            ],
            [
                'created_by' => 3,
                'participant_id' => 4,
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Message::factory()->createMany([
            [
                'conversation_id' => 1,
                'sender_id' => 1,
                'content' => 'Hello Emma',
            ],
            [
                'conversation_id' => 1,
                'sender_id' => 2,
                'content' => 'Hello Richard',
            ],
            [
                'conversation_id' => 2,
                'sender_id' => 1,
                'content' => 'Hello Benji',
            ],
            [
                'conversation_id' => 2,
                'sender_id' => 3,
                'content' => 'Hello Richard',
            ],
            [
                'conversation_id' => 3,
                'sender_id' => 1,
                'content' => 'Hello Mohamed',
            ],
            [
                'conversation_id' => 3,
                'sender_id' => 4,
                'content' => 'Hello Richard',
            ],
            [
                'conversation_id' => 4,
                'sender_id' => 2,
                'content' => 'Hello Benji',
            ],
            [
                'conversation_id' => 4,
                'sender_id' => 3,
                'content' => 'Hello Emma',
            ],
            [
                'conversation_id' => 5,
                'sender_id' => 2,
                'content' => 'Hello Mohamed',
            ],
            [
                'conversation_id' => 5,
                'sender_id' => 4,
                'content' => 'Hello Emma',
            ],
            [
                'conversation_id' => 6,
                'sender_id' => 3,
                'content' => 'Hello Mohamed',
            ],
            [
                'conversation_id' => 6,
                'sender_id' => 4,
                'content' => 'Hello Benji',
            ],
        ]);
    }
}

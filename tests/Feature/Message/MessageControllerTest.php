<?php

namespace Tests\Unit;

use App\Http\Controllers\MessageController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Http\Request;

class MessageControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function testRoomsValidRequestWithConversations()
    {
        // Créez un utilisateur et des messages pour cet utilisateur
        $user = User::factory()->create();
        Message::factory()->count(3)->create(['sender_id' => $user->id]);

        $request = new Request(['user_id' => $user->id]);

        $controller = new MessageController();

        $response = $controller->rooms($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertNotEmpty($response->getData()->data);
    }

    public function testRoomsValidRequestWithoutConversations()
    {
        // Créez un utilisateur sans messages
        $user = User::factory()->create();

        $request = new Request(['user_id' => $user->id]);

        $controller = new MessageController();

        $response = $controller->rooms($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEmpty($response->getData()->data);
    }

    public function testRoomsInvalidRequest()
    {
        // Fournir un ID d'utilisateur qui n'existe pas
        $request = new Request(['user_id' => 999]);

        $controller = new MessageController();

        $response = $controller->rooms($request);

        $this->assertEquals(422, $response->getStatusCode());
    }
}

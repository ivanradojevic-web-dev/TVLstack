<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FriendsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_send_a_friend_request()
    {
        $this->withoutExceptionHandling();
        
        $this->actingAs($user = factory(\App\User::class)->create(), 'api');
        $anotherUser = factory(\App\User::class)->create();

        $response = $this->post('/api/friend-request', [
            "friend_id" => $anotherUser->id,
        ])->assertStatus(200);
     
    }
}

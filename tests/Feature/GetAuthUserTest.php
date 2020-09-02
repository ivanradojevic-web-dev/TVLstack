<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetAuthUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_is_auth()
    {
        $this->withoutExceptionHandling();
        
        $this->actingAs($user = factory(\App\User::class)->create(), 'api');
        

        $response = $this->get('/api/auth-user');

        $response->assertStatus(200)
            ->assertJson([

                "data" => [
                    "type" => "users",
                    "user_id" => $user->id,
                    "attributes" => [
                        "name" => $user->name,

                    ]
                ], 

                "links" => [
                    "self" => url("/users/".$user->id),
                ]   

            ]);
    }
}

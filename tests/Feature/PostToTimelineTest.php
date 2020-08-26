<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostToTimelineTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_post_a_text_posts()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($user = factory(\App\User::class)->create(), "api");

        $response = $this->post("/api/posts",[
            "data" => [
                "type" => "posts",
                "attributes" => [
                    "body" => "Testing Body",
                ]

            ]
        ]);

        $post = \App\Post::first();

        $response->assertStatus(201);
    }
}

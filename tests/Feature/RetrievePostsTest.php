<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RetrievePostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_retrieve_posts()
    {
        $this->withoutExceptionHandling();
        
        $this->actingAs($user = factory(\App\User::class)->create(), 'api');
        $posts = factory(\App\Post::class, 2)->create(["user_id" => $user->id]);

        $response = $this->get('/api/posts');

        $response->assertStatus(200)
            ->assertJson([

            "data" => [  

                [
                    "data" => [
                        "type" => "posts",
                        "post_id" => $posts->first()->id,
                        "attributes" => [
                            //"posted_by" => new User($this->user),   //new User from resource(relationship from model)
                            "body" => $posts->first()->body,
                        ]
                    ]
                ],
                [
                    "data" => [
                        "type" => "posts",
                        "post_id" => $posts->last()->id,
                        "attributes" => [
                            //"posted_by" => new User($this->user),   //new User from resource(relationship from model)
                            "body" => $posts->last()->body,
                        ]
                    ]
                ],
                
            ],

            "links" => [
                    "self" => url("/posts"),
            ]    

            ]);
    }

    /** @test */
    public function a_user_can_only_retrieve_their_posts()
    {
        //$this->withoutExceptionHandling();
        
        $this->actingAs($user = factory(\App\User::class)->create(), 'api');
        $posts = factory(\App\Post::class)->create();

        $response = $this->get('/api/posts');

        $response->assertStatus(200)
            ->assertExactJson([

            "data" => [], 
            "links" => [
                "self" => url("/posts"),
            ]    

            ]);
    }
}


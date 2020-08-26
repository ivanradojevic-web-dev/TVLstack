<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            //'body' => ['required'],
            'data.attributes.body' => '',	//testing
        ]);

        //$post = auth()->user()->posts()->create($data);
        $post = auth()->user()->posts()->create($data['data']['attributes']);	//testing

    	return response([
    		"data" => [
                    "type" => "posts",
                    "post_id" => $post->id,
                    "attributes" => [
                        "body" => $post->body,
                    ]
                ],
                "links" => [
                    "self" => url("/posts/".$post->id),
                ]
    	], 201);
    }
}

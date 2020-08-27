<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Post as PostResource; 

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

        return new PostResource($post);

    	//return response([], 201);
    }
}

// new PostResource($post);
// PostResource::collection($post);

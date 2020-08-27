<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\PostCollection;
use App\Post; 

class PostController extends Controller
{

	public function index()
    {
        $posts = Post::all();

        return new PostCollection(auth()->user()->posts);  //another way to retrieve collection
    }

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FriendRequestResponseController extends Controller
{
    public function store(Request $request)
    {
        $data = request()->validate([
            'user_id' => '', 
            'status' => '',
        ]);

        //User::findOrFail($data['friend_id'])->friends()->attach(auth()->user());

        $friendRequest = Friend::where("user_id", $data['user_id'])
                ->where("friend_id", auth()->user()->id)
                ->firstOrFail();

        //try {
        //    User::findOrFail($data['friend_id'])
        //        ->friends()->attach(auth()->user());
        //} catch (ModelNotFoundException $e) {
        //    throw new UserNotFoundException();
        //}

        $friendRequest->update(array_merge($data, [
            'confirmed_at' => now(),
        ]));

        return new FriendResource($friendRequest);
    
}

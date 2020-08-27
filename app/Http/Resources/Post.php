<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User;

class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "data" => [
                    "type" => "posts",
                    "post_id" => $this->id,
                    "attributes" => [
                        "posted_by" => new User($this->user),   //new User from resource(relationship from model)
                        "body" => $this->body,
                    ]
            ],
            "links" => [
                    "self" => url("/posts/".$this->id),
            ]
        ];
    }
}

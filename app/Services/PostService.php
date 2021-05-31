<?php

namespace App\Services;

use App\Http\Resources\PostResource;
use App\Models\Post;

class PostService{
    public function getAllPost(){
        return PostResource::collection(Post::all());
    }
}
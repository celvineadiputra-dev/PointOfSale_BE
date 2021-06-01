<?php

namespace App\Services;

use App\Helpers\HashId;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Exception;
use Illuminate\Support\Str;

class PostService
{

    public function getAllPost()
    {
        return PostResource::collection(Post::all());
    }

    public function storePost($request)
    {
        $request['slug'] = Str::slug($request->title);
        $post = Post::create($request->all());
        return new PostResource($post);
    }

    public function getPost($post)
    {
        try {
            $postId = HashId::hashid_encode($post);
            $post = Post::where('id', $postId)->first();
            if ($post) {
                return new PostResource($post);
            }
            throw new Exception("ID NOT FOUND");
        } catch (Exception $e) {
            throw new Exception("ID NOT FOUND");
        }
    }

    public function updatePost($request, $post)
    {
        try {
            $postId = HashId::hashid_encode($post);
            $data = Post::where('id', $postId);
            if ($data->count() > 0) {
                $request['slug'] = Str::slug($request->title);
                $updateData = $data->update($request->all());
                if ($updateData == 1) {
                    return new PostResource(Post::where('id', $postId)->first());
                } else {
                    throw new Exception('Data gagal di update');
                }
            } else {
                throw new Exception('ID NOT FOUND');
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function destoryPost($post){
        try {
            $postId = HashId::hashid_encode($post);
            $data = Post::where('id', $postId);
            if ($data->count() > 0) {
                $deleteData = $data->delete();
                if ($deleteData) {
                    return null;
                } else {
                    throw new Exception('Data gagal di hapus');
                }
            } else {
                throw new Exception('ID NOT FOUND');
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}

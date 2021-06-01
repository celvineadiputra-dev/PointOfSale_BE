<?php

namespace App\Http\Controllers;

use App\Helpers\HashId;
use App\Http\Controllers\API\ResponseJson;
use App\Services\PostService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    private $service;

    public function __construct(PostService $postService)
    {
        $this->service = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $post = $this->service->getAllPost();
            return ResponseJson::success($post, 'Data POST berhasil di ambil');
        } catch (Exception $e) {
            return ResponseJson::error($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return ResponseJson::error($validator->errors());
        }
        try {
            $post = $this->service->storePost($request);
            return ResponseJson::success($post, 'Data berhasil di tambahkan');
        } catch (Exception $e) {
            return ResponseJson::error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        try {
            $post = $this->service->getPost($post);
            return ResponseJson::success($post, 'Data berhasil di dapatkan');
        } catch (Exception $e) {
            return ResponseJson::error($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts,title,' . HashId::hashid_encode($post) . '|max:255',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return ResponseJson::error($validator->errors());
        }
        try {
            $post = $this->service->updatePost($request, $post);
            return ResponseJson::success($post, 'Data berhasil di update');
        } catch (Exception $e) {
            return ResponseJson::error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        try{
            $post = $this->service->destoryPost($post);
            return ResponseJson::success($post, 'Data berhasil di hapus');
        }catch(Exception $e){
            return ResponseJson::error($e->getMessage());
        }
    }
}

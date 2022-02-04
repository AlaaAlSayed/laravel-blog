<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource ;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = Post::paginate();
        return  PostResource :: collection ($allPosts);
    }

    public function show($postId)
    {
        $post = Post::find($postId);
        return new PostResource($post);
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->all();


        $post = Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],
        ]);

        return new PostResource($post);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;


class PostController extends Controller
{

    public function index()
    {
        $allPosts = Post::simplePaginate(2); //to retrieve all records

        return view('posts.index', [
            'allPosts' => $allPosts,
        ]);
    }

    public function create()
    {
        $users = User::all();

        return view('posts.create', [
            'users' => $users
        ]);
    }


    public function store()
    {
        //the logic to store post in the db
        $data = request()->all();

        // Post::create($data);
        Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],

        ]);

        return redirect()->route('posts.index');
    }

    public function show($postId)
    {
        //query in db select * from posts where id = $postId
        $post = Post::where('id', $postId)->get()->first();

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function edit($postId)
    {
        // query in db select * from posts where id = $postId
        // then fill the fields with retrived data 

        $post = Post::where('id', $postId)->get()->first();
        $users = User::all();

        return view('posts.edit', [
            'post' => $post,
            'users' => $users
        ]);
    }

    public function update($postId)
    {
        $data = request()->all();

        // query in db update table set ()=() where id = $postId
         $post = Post :: where('id', $postId)-> update([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],
        ]);
        return redirect()->route('posts.show',$post);
    }

    public function destroy($postId)
    {
        // query in db select * from posts where id = $postId
        $deleted = Post :: where('id', $postId)->delete();
        dd($deleted);
        // return $postId;
        return redirect()->route('posts.index');

    }

   
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

use App\Models\Post;
use App\Models\User;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use DB;

class PostController extends Controller
{

    public function index()
    {

        $allPosts = Post::simplePaginate(4); //to retrieve all records

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


    public function store(StorePostRequest $request)
    {

        // request()->validate([
        //     'title' => ['required', 'min:3'],
        //     'description' => ['required', 'min:5'],
        // ],[
        //     'title.required' => 'must enter title',
        //     'title.min' => 'the min title is 3'
        // ]);
       

        //the logic to store post in the db
        $data = $request->all();

        if (isset($data)) {
            $user = User::where('id', $data['post_creator'])->get()->first();
            if ($user) {
                // Post::create($data);
                Post::create([
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'user_id' => $data['post_creator'],
                ]);
            }
        }
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
    // Integrity constraint violation:  a foreign key constraint fails 
    // 
    public function update($postId, UpdatePostRequest $request)
    {
     
        //the logic to store post in the db
        $data = $request->only ( 'title','description','post_creator');//validated();

        // make sure when updating post without changing Title it still works
        if (isset($data)) {

            $user = User::where('id', $data['post_creator'])->get()->first();

            if ($user) {
                // query in db update table where id = $postId
                Post::where('id', $postId)->update([
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'user_id' => $data['post_creator'],
                ]);
         
            }
        } else {

            $data = Post::where('id', $postId)->get()->first();
        }

        return redirect()->route('posts.show', $postId);
    }

    public function destroy($postId)
    {
        // query in db select * from posts where id = $postId
        $deleted = Post::where('id', $postId)->delete();
        // dd($deleted);
        // return $postId;
        return redirect()->route('posts.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class postController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('posts.index')->with('posts',$posts);
    }

    public function create(){
        $users = User::all();
        return view('posts.create')->with('users',$users);
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required|min:5|max:255',
            'creatorPost' => 'required'
        ]);
        $title = $request->input('title');
        $description = $request->input('description');
        $creator = $request->input('creatorPost');
        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $creator
        ]);
        return redirect()->route('posts.index')->with('success','Post created successfully.');
    }

    public function show($idPost){
        $post = Post::find($idPost);
        if(!$post){
            return redirect()->route('posts.index')->with('error','Post not fond.');
        }
        return view('posts.show')->with('post',$post);
    }

    public function edit($idPost){
        $post = Post::find($idPost);
        $users = User::all();
        return view('posts.edit')->with('postId',$idPost)->with('post',$post)->with('users',$users);
    }

    public function update(Request $request, $idPost){
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required|min:5|max:255',
            'creatorPost' => 'required'
        ]);
        $title = $request->input('title');
        $description = $request->input('description');
        $creatorPost = $request->input('creatorPost');
        $post = Post::find($idPost);
        if($post){
            $post->update([
                'title' => $title,
                'description' => $description,
                'user_id' => $creatorPost,
            ]);
            return redirect()->route('posts.show', $idPost);
        }
        return redirect()->route('posts.index')->with('error','Post not fond.');
    }

    public function destroy($idPost){
        $post = Post::find($idPost);
        if($post){
            $post->delete();
            return redirect()->route('posts.index')->with('success','The post was deleted successfully.');
        }
        return redirect()->route('posts.index')->with('error','Post not fond.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;

class PostController extends Controller
{
    public function deletePost(Post $post){
        if(auth()->user()->id === $post['user_id']){
            $post->delete();
        }
        return redirect('/');
    }

    public function updatePost(Post $post, Request $request){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'nullable'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/users/', $filename);
            $incomingFields['image'] = $filename;
        }

        $post->update($incomingFields);
        return redirect('/');
    }

    public function showEditScreen(Post $post){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }

        return view('edit-post', ['post' => $post]);
    }

    public function createPost(Request $request){
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'nullable'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        if($request->hasfile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/users/', $filename);
            $incomingFields['image'] = $filename;
        }
        $incomingFields['user_id'] = auth()->id();
        Post::create($incomingFields);
        return redirect('/');
    }
}

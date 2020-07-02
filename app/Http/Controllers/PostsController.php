<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Session;

class PostsController extends Controller
{
    public function index(){
        //fetch all posts data
        $posts = Post::orderBy('created','desc')->get();

        //pass posts data to view and load list view
        return view('posts.index', ['posts' => $posts]);
    }

    public function details($id){
        //fetch post data
        $post = Post::find($id);

        //pass posts data to view and load list view
    }

    public function add(){
        //load form view
        return view('posts.add');
    }

    public function insert(Request $request){
        //validate post data
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);

        //get post data
        $postData = $request->all();

        //insert post data
        Post::create($postData);

        //store status message
        Session::flash('success_msg', 'Post added successfully!');

        return redirect()->route('posts.index');
    }

    public function edit($id){
        //get post data by id
        //$post = Post::find($id);

        //load form view
        $user = User::find($id);
        return view('edit',["user"=>$user]);
    }

    public function update($id, Request $request){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required'
        ]);

        //get post data
        $postData = $request->all();

        User::find($id)->update($postData);

        Session::flash('success_msg', 'Post updated successfully!');

        return redirect()->route('home');
    }

    public function delete($id){
        //update post data
        Post::find($id)->delete();

        //store status message
        Session::flash('success_msg', 'Post deleted successfully!');

      //  return redirect()->route('posts.index');
    }


    public function back(){
        return redirect()->route('home');
    }
}

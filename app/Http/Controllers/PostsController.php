<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;
use DB;

use Illuminate\Http\Request;

use Session;

class PostsController extends Controller
{
    public function index(){
        $posts = Post::orderBy('created','desc')->get();
        return view('posts.index', ['posts' => $posts]);
    }

    public function details($id){
        $post = Post::find($id);
    }

    public function add(){
        return view('posts.add');
    }

    public function insert(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);
        $postData = $request->all();
        Post::create($postData);
        Session::flash('success_msg', 'Post added successfully!');

        return redirect()->route('posts.index');
    }

    public function edit($id){
        $user = User::find($id);
        return view('edit',["user"=>$user]);
    }

    public function update($id, Request $request){

      /* $status=$request->get('status');
        $name=$request->get('name');
        echo $name;
        echo $status;*/

      $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'status' => 'required'
        ]);

        $postData = $request->all();

       // User::find($id)->update($postData);

        DB::Table('users')->where('id',$id)->update(
            array(
                'status' =>  $request->get('status'),
                'name' =>  $request->get('name'),
                'email' =>  $request->get('email')
            )
        );


        Session::flash('success_msg', 'Post updated successfully!');

        return redirect()->route('home');
    }

    public function delete($id){
        Post::find($id)->delete();
        Session::flash('success_msg', 'Post deleted successfully!');
    }
    /*public function changeStatus($id,$currentStatus){
        $currentUser = User::find($id);
        if($currentStatus==0){
            $currentUser->update([
                'status' =>  $request->input('name', $user->name)
            ]);

            $result =  DB::Table('users')->where('id',$id)->update(
                array(
                    'status' =>  $request->name
                )
            );
        }else{

        }
    }*/

    public function back(){
        return redirect()->route('home');
    }
}

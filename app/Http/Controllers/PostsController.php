<?php namespace App\Http\Controllers;
use App\Post;
use App\User;
use DB;

use Illuminate\Http\Request;

use Session;

class PostsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::orderBy('created','desc')->get();
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * @param $id
     */
    public function details($id)
    {
        $post = Post::find($id);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        return view('posts.add');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function insert(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);
        $postData = $request->all();
        Post::create($postData);
        Session::flash('success_msg', 'Post added successfully!');

        return redirect()->route('posts.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('edit',["user"=>$user]);
    }

    /**
     * Show the application dashboard.
     * @author sebastian miranda
     * @param String $id
     * @param Request $request
     * @return A View HOME
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'status' => 'required'
        ]);

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

    public function delete($id)
    {
        Post::find($id)->delete();
        Session::flash('success_msg', 'Post deleted successfully!');
    }
    public function back(){
        return redirect()->route('home');
    }
}

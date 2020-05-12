<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
class PostsController extends Controller
{
    //
    public function __construct(){
      $this->middleware('auth');
    }
    public function index(){
      $posts = Post::limit(10)->latest()->get();
      return view('posts.index')->with('posts' , $posts);
    }

    public function new(){
      return view('posts.new');
    }

    public function store(Request $request){
      $this->validate($request , [
        'caption' => 'max:255',
        'photo' => 'required'
      ]);


      $post = new Post;
      $post->caption = $request->caption;
      $post->user_id = Auth::user()->id;

      $post->save();
      if($request->hasFile('photo')){
        if($request->file('photo')->isValid()){
          $request->photo->storeAs('public/post_images', $post->id . '.jpg');
        }
      }

      return redirect('/');
    }

    public function destroy($post_id){
      $post = Post::findOrFail($post_id);
      $post->delete();
      return redirect('/');
    }
}

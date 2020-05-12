<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Comment;
class CommentsController extends Controller
{
    //

    public function __construct(){
      $this->middleware('auth');
    }
    public function store(Request $request){
      $this->validate($request , [
        'comment' => 'required|max:50'
      ]);

      $comment = new Comment;
      $comment->comment = $request->comment;
      $comment->post_id = $request->post_id;
      $comment->user_id = Auth::user()->id;
      $comment->save();

      return redirect('/');
    }

    public function destroy(Request $request){
      $comment= Comment::findOrFail($request->comment_id);
      $comment->delete();
      return redirect('/');
    }
}

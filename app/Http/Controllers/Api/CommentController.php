<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create(Request $request) {
        
        $comment = new Comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;
        $comment->save();


        return $this->getComments($request->post_id); 
        
    }

    public function getComments($post_id){
        $comments = Comment::where('post_id', $post_id)->with('user')->get();
        return response()->json($comments);
    }

    public function remove($id){
        Comment::find($id)->delete();
        return response()->json(['success']);

    }
}

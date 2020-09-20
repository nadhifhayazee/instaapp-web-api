<?php

namespace App\Http\Controllers\Api;

use App\Like;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Request $request){
        $like = Like::where(
            ['user_id' => Auth::user()->id],
            ['post_id' => $request->post_id])->first();

            $post = Post::where('id', $request->post_id)->with('likes')->first();
            //echo $post;
            //die;

        // $post = Post::find($request->post_id)->with(array('likes') => function($query){

        //     $query->where('user')
        // });    
      // echo $like;
       //die;    
        if ($post['isLiked']){
            $like->delete();
            //Post::find($request->post_id)->likes()->attach(User::find($request->user_id));
          //  $like = "";
            return response()->json(['liked' => false]);
        } 
        $like = new Like;
        $like->user_id = Auth::user()->id;
        $like->post_id = $request->post_id;
        $like->save();

        //Post::find($request->post_id)->likes()->detach(User::find($request->user_id));
        return response()->json(['liked' => true]);


    }

    public function unlike($post_id){
        Like::where(
            ['user_id',Auth::user()->id],
            ['post_id',$post_id])->remove();

        return response()->json(['success']);
    
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(){
        $posts = Post::with('user','comments','likes')->orderBy('id', 'DESC')->get();
        return response()->json($posts);
    }

    public function create(Request $request){
        
        $post = new Post;
        $post->user_id = Auth::user()->id;
        $post->caption = $request->caption;

        if($request->hasFile('post_image')){
            $post->post_image = $request->file('post_image')->getClientOriginalName();
            $foto = $request->file('post_image');
            $namaFoto = $foto->getClientOriginalName();
            $path = $foto->move(public_path('/postImages'), $namaFoto);
        }

        $post->save();

        $result = Post::with('user','comments','likes')->where('id',$post->id)->first();
        return response()->json($result);
    }

    public function update(Request $request, $id){
        $post = Post::find($id);
        //$post->user_id = Auth::user()->id;
        $post->caption = $request->caption;

        if($request->hasFile('post_image')){
            $post->post_image = $request->file('post_image')->getClientOriginalName();
            $foto = $request->file('post_image');
            $namaFoto = $foto->getClientOriginalName();
            $path = $foto->move(public_path('/postImages'), $namaFoto);
        }

        $post->save();

        return response()->json('success');
    }

    public function show($id){
        $post = Post::find($id)->with('comments')->get()->first(); 
        return response()->json($post);
    }

    public function remove($id){
        Post::find($id)->delete();
        return response()->json(['success']);
    }


}

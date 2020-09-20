<?php

namespace App\Http\Controllers\Api;

use App\FollowerUser;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    public function register(Request $request){
        $validator =  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'between:8,255'] 
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $token = Str::random(60);
       $user = User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'api_token' => $token,
        ]);

        return response()->json($user);
    }

    public function login(){
        if(Auth::attempt(['username' => request('username'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            return response()->json($user); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

    public function getUser($username){
        $user = User::where('username', $username)->with(array('followers','followings','posts' => function($query) {
            $query->orderBy('posts.id', 'DESC');
        } ))->first();
        
       
        $user['follower'] = count($user['followers']);
        $user['followed'] = count($user['followings']);
        $user['isFollowed'] = $this->isFollowed($user['id']);
        
        return response()->json($user); 
    }

    
    public function follow($id){
          
        if (!$this->isFollowed($id)){
            User::find($id)->followers()->attach(User::find(Auth::user()->id));
            return response()->json(['message' => 'followed']);
            
        } else {
            User::find(Auth::user()->id)->followings()->detach(User::find($id));
            return response()->json(['message'  => 'unfollowed']);

        }

    }
    
    public function isFollowed($follower_id){
        $follower = FollowerUser::where(
            ['user_id' => $follower_id],
            ['follower_id' => Auth::user()->id])->first();
        
        if ($follower == null){
            return false;
        } 

        return true;
    }
}

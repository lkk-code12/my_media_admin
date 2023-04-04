<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //get all post
    public function getAllPost(){
        $post = Post::get();
        return response()->json([
            'post' => $post
        ]);
    }

    //search post
    public function postSearch(Request $request){
        // logger($request->all());
        $post = Post::where('post_title','LIKE','%'.$request->searchData.'%')
                                ->get();
        return response()->json([
            'searchResult' => $post
        ]);
    }

    //post details
    public function postDetails(Request $request){
        $id = $request->postId;
        $post = Post::where('post_id',$id)->first();
        return response()->json([
            'post' => $post
        ]);
    }
}

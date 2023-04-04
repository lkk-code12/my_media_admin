<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //get all category
    public function getAllCategory(){
        $category = Category::select('category_id','category_title','category_description')
                                ->get();
        // dd($category);
        return response()->json([
            'category' => $category
        ]);
    }

    //category search
    public function categorySearch(Request $request){
        // logger($request->all());
        $category = Category::select('posts.*')
                            ->join('posts','posts.category_id','categories.category_id')
                            ->where('categories.category_title','LIKE','%'.$request->searchKey.'%')
                            ->get();
        return response()->json([
            'result' => $category
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct admin category
    public function index(){
        $category = Category::get();
        return view('ADMIN.CATEGORY.index', compact('category'));
    }

    //admin create category
    public function create(Request $request){
        $validator = $this->categoryValidationCheck($request);
        if($validator->fails()){
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = $this->getCategoryData($request);
        Category::create($data);
        return back();
    }

    //category delete
    public function delete($id){
        Category::where('category_id', $id)->delete();
        return back()->with(['deleted'=>'Category has been deleted']);
    }

    //category search
    public function search(Request $request){
        $category = Category::orWhere('category_id','like','%'.$request->searchCategory.'%')
                                ->orWhere('category_title','like','%'.$request->searchCategory.'%')
                                ->orWhere('category_description','like','%'.$request->searchCategory.'%')
                                ->get();
        return view('ADMIN.CATEGORY.index', compact('category'));
    }

    //category edit
    public function editCategoryPage($id){
        $data = Category::where('category_id',$id)->first();
        // dd($data->toArray());
        return view('ADMIN.CATEGORY.editCategory',compact('data'));
    }

    //category update
    public function updateCategory(Request $request, $id){
        $category = Category::get();
        $validator = $this->categoryValidationCheck($request);
        if($validator->fails()){
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        Category::where('category_id', $id)
                            ->update([
                                'category_title' => $request->categoryName,
                                'category_description' => $request->categoryDescription
                            ]);
        return redirect()->route('admin#category');
    }

    //category validation check
    private function categoryValidationCheck($request){
        return
            Validator::make($request->all(),[
                'categoryName' => 'required',
                'categoryDescription' => 'required'
            ],[
                'categoryName.required' => 'Fill category name',
                'categoryDescription.required' => 'Fill description'
            ]);
    }

    //get category data
    private function getCategoryData($request){
        return [
            'category_title' => $request->categoryName,
            'category_description' => $request->categoryDescription,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}

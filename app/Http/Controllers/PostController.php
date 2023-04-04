<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //direct admin post
    public function index(){
        $categories = Category::get();
        $posts = Post::get();
        // dd($categories->toArray());
        return view('ADMIN.POST.index', compact('categories','posts'));
    }

    //create post
    public function createPost(Request $request){
        $validator = $this->checkValidation($request);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        if(!empty($request->postImage)){
            $file = $request->file('postImage');
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/postImage',$fileName);

            $data = $this->getPostData($request, $fileName);
        }else{
            $data = $this->getPostData($request, NULL);
        }

        Post::create($data);
        return back();
    }

    //delete post
    public function deletePost($id){
        $postData = Post::where('post_id', $id)->first();
        // dd($postData['post_image']);
        $dbImageName = $postData['post_image'];
        // dd($dbImageName);

        if(File::exists(public_path().'/postImage/'.$dbImageName)){
            File::delete(public_path().'/postImage/'.$dbImageName);
        }
        Post::where('post_id', $id)->delete();
        return back();
    }

    //update post page
    public function updatePostPage($id){
        $postData = Post::where('post_id',$id)->first();
        // dd($postData->toArray());
        $categories = Category::get();
        return view('ADMIN.POST.updatePostPage', compact('postData','categories'));
    }

    //update post
    public function updatePost($id, Request $request){
        // dd($id);
        // dd($request->all());
        $validator = $this->checkValidation($request);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $updateData = $this->requestPostData($request);
        // dd($updateData);
        if(isset($request->postImage)){
            //get image from client
            $file = $request->file('postImage');
            // dd($file);
            $fileName = uniqid().'_'.$file->getClientOriginalName();

            //put new image to data array
            $updateData['post_image'] = $fileName;
            // dd($updateData);

            //get image from database
            $postData = Post::where('post_id', $id)->first();
            $dbImageName =  $postData['post_image'];
            // dd($dbImageName);

            //delete image from public folder
            if(File::exists(public_path().'/postImage/'.$dbImageName)){
                File::delete(public_path().'/postImage/'.$dbImageName);
            }

            //store new image under public folder
            $file->move(public_path().'/postImage',$fileName);

            //update new image
            Post::where('post_id',$id)->update($updateData);
        }else{
            Post::where('post_id',$id)->update($updateData);
        }
        return back();
    }

    //request post data
    private function requestPostData($request){
        return [
            'post_title' => $request->postTitle,
            'post_description' => $request->description,
            // 'post_image' => $request->postImage,
            'category_id' => $request->postCategory
        ];
    }

    // post image
    private function getPostData($request, $fileName){
        return [
            'post_title' => $request->postTitle,
            'post_description' => $request->description,
            'post_image' => $fileName,
            'category_id' => $request->postCategory
        ];
    }

    //post validation check
    private function checkValidation($request){
        return
            Validator::make($request->all(),[
                'postTitle' => 'required',
                'description' => 'required',
                'postCategory' => 'required'
            ],[
                'postTitle.required' => 'Fill title.',
                'description.required' => 'Fill description',
                'postCategory.required' => 'Choose category'
            ]);
    }
}

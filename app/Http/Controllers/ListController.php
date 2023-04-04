<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class ListController extends Controller
{
    //direct admin list
    public function index(){
        $userData = User::get();
        // dd($userData->toArray());
        return view('ADMIN.LIST.index',compact('userData'));
    }

    //delete admin
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['success'=>'Account has been deleted!']);
    }

    //admin search
    public function search(Request $request){
        $userData = User::orWhere('name', 'like', '%'.$request->adminSearch.'%')
                        ->orWhere('email', 'like', '%'.$request->adminSearch.'%')
                        ->orWhere('phone', 'like', '%'.$request->adminSearch.'%')
                        ->orWhere('address', 'like', '%'.$request->adminSearch.'%')
                        ->orWhere('gender', 'like', '%'.$request->adminSearch.'%')
                        ->get();
        return view('ADMIN.LIST.index',compact('userData'));
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //direct home page
    public function index(){
        $id = Auth::user()->id;
        // dd($id);

        $user_info = User::select('id','name','email','phone','address','gender')
                        ->where('id',$id)
                        ->first();
        // dd($user_info->toArray());
        return view('ADMIN.PROFILE.index',compact('user_info'));//->with(['userInfo'=>$user_info]);
    }

    //admin update
    public function adminUpdate(Request $request){
        // dd($request->all());
        $userData = $this->getUserInfo($request);
        // dd($userData);

        $validator = $this->userValidationCheck($request);
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $updateData = User::where('id',Auth::user()->id)
                        ->update($userData);
        return back()->with(['updateProfileSuccess'=>'Profile has been updated.']);
    }

    //route to admin change password page
    public function changePasswordPage(){
        return view('ADMIN.PROFILE.changePassword');
    }

    //change password
    public function changePassword(Request $request){
        $validator = $this->adminPasswordValidationCheck($request);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $dbData = User::where('id',Auth::user()->id)->first();
        $dbPassword = $dbData->password;
        $hashNewPassword = Hash::make($request->newPassword);

        if(Hash::check($request->oldPassword, $dbPassword)){
            User::where('id',Auth::user()->id)->update(['password'=>$hashNewPassword, 'updated_at'=>Carbon::now()]);
            return redirect('dashboard');
        }else{
            return back()->with(['fail'=>'old password does not match!']);
        }
    }

    //get user info
    private function getUserInfo($request){
        return [
            'name' => $request->inputName,
            'email'=> $request->inputEmail,
            'phone' => $request->inputPhone,
            'address' => $request->inputAddress,
            'gender' => $request->inputGender,
            'updated_at' => Carbon::now()
        ];
    }

    //user validation check
    private function userValidationCheck($request){
        return Validator::make($request->all(), [
            'inputName' => 'required',
            'inputEmail' => 'required',
        ],[
            //custom validation messages can be written here
            'inputName.required' => 'Fill your name',
            'inputEmail.required' => 'Fill your email'
        ]);
    }

    //user password validation check
    private function adminPasswordValidationCheck($request){
        return Validator::make($request->all(),[
            'oldPassword' => 'required',
            'newPassword' =>'required|min:8|max:15',
            'confirmNewPassword' => 'required|same:newPassword|min:8|max:15'
        ],[
            'oldPassword.required' => 'fill old password',
            'newPassword.required' => 'fill new password',
            'confirmNewPassword.required' => 'new password & confirm password must be same'
        ]);
    }
}

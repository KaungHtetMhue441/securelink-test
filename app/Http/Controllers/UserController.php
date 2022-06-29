<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function register(){
        return view('user.register');
    }
    function login(){
        return view('user.login');
    }
    function store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:12',
            'confirmpassword'=>'required|min:5|max:12|same:password'
        ]);


         $user = new User();
         $user->name = $request->name;
         $user->email = $request->email;
         $user->password = Hash::make($request->password);
         $save = $user->save();
         if($save){
            return redirect('user/login')->with('success','Successful register! Please login');
         }else{
             return redirect('user/rgister')->with('fail','Something went wrong, try again later');
         }
     }

    function check(Request $request){
        $request->validate([
             'email'=>'required|email|exists:users',
             'password'=>'required'
        ]);

        $userInfo = User::where('email','=', $request->email)->first();

        if(!$userInfo){
            return back()->with('email','We do not recognize your email address');
        }else{
            //check password
            if(Hash::check($request->password, $userInfo->password)){
                $request->session()->put('LoggedUser', $userInfo->id);
                return redirect()->route('home')->with('success','Login successful');
            }else{
                return back()->with('password','Incorrect password');
            }
        }
    }

    function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect()->route('login');
        }
    }

}

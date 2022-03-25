<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    
    public function registration(){
        return view('auth.registration');
    }

    public function doRegistration(Request $request){
        // dd($request->all());
        $inputs=[
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password),
            'role'=>$request->role,
        ];

        User::create($inputs);
        // return redirect('login');
        return redirect()->route('login');
    }

    public function doLogin(Request $request){
        // dd($request->all());
        $creds=$request->except('_token');
        if (\auth()->attempt($creds)) {
            if (auth()->user()->role=="Admin") {
                return redirect()->route('admin.dashboard');
            }elseif (auth()->user()->role=="Customer") {
                return redirect()->route('frontend.index');
            }            
        }
    }
    
    public function doLogout(Request $request){
        auth()->logout();
        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserAccountsController extends Controller
{
    //Function For Registration
    public function addUser(Request $request){

        $userDetails = $request->validate([

            'regusername' => ['required', Rule::unique('users', 'regusername')],
            'regemail' => ['required'],
            'password' => ['required'],
            'confirmpassword' => ['required', 'same:password']

        ]);

        if($userDetails['password'] !== $userDetails['confirmpassword']){

            return redirect()->back()->withInput()->withErrors(['regpassword' => 'Password Does Not Match']);

        }else{

            $userDetails['password'] = bcrypt($userDetails['password']);
            $userModel = User::create($userDetails);
            auth()->login($userModel);

            return redirect('/')->with('adduser', 'User Account Has Been Registered');

        }

    }

    //Function For Login
    public function login(Request $request){

        $userDetails = $request->validate([

            'loginusername' => 'required',
            'loginpassword' => 'required',

        ]);

        if(auth()->attempt(['regusername' => $userDetails['loginusername'], 'password' => $userDetails['loginpassword']], true)){

            $request->session()->regenerate();
            return redirect('/dashboard');

        }

        return redirect('/')->with('loginError', 'Invalid Credentials');


    }

    //function for User Logout
    public function logout(){

        auth()->logout();
        return redirect('/');

    }
}

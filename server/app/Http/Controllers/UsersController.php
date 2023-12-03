<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //Registration User
    function Register(Request $request)
    {
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->save();
        return $data;
        // return $request->input();
        // return $request->all();
    }

    function Login(Request $req)
    {
        $user= User::where('email',$req->email)->first();
        
        /*First Methods  */
        
        // if(!$user || !Hash::check($req->password,$user->password))
        // {
        //     return response([
        //         'error'=>"Email or password dose not matched"
        //     ]);
        // }
        // return $user;

        /* Second Methods */
        $email=$req->email;
        $password=$req->password;

       if(Auth::attempt(['email'=>$email,'password'=>$password]))
       {
            return $user;
            // return redirect()->intended('admin/dashboard');
       }

       return response(["Error" => "Invalid Login"]);
    //    return Redirect::to('login');
    }
}

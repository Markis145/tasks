<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;

class RegisterAltController extends Controller
{
    function register(StoreUser $request){
        $user = User::where('email', $request->email)->first();
        if (!$user){
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::login($user);
            return redirect('/home');
        }
        if($user){
            return 'El usuari ja existeix';
        }
    }
}
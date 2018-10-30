<?php
/**
 * Created by PhpStorm.
 * User: marcmestre
 * Date: 26/10/18
 * Time: 16:45
 */

namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginAltController
{
//    public function login(LoginRequest)
//    {
//        //obligat passar email i password
//        //TODO -> VALIDATE
//    }

    public function login(Request $request)
    {
//        TODO->VALIDATE
//        $request->email
//        $request->password
        //Buscar el usuari a la base de dades i comprovar password ok
        $user = User::where('email',$request->email)->first();

        if (!$user) return redirect('/');
        if (!Hash::check($request->password, $user->password)) return redirect('/');
        Auth::login($user);
        return redirect('/home');
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\Avatars\AvatarStore;
use App\Avatar;

class FeaturesController extends Controller
{

    public function index(){
        return view('features');
    }
}

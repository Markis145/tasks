<?php

namespace App\Http\Controllers;

use App\Http\Requests\Multimedia;


class MultimediaController extends Controller
{

    public function index(Multimedia $request)
    {

        return view('multimedia.index');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CropImageController extends Controller
{
    public function index()
    {
        return view('crop-image.crop-image');
    }

    public function uploadImage(Request $request)
    {
        info($request->all());
//        dd($request->all());
        return true;
    }
}

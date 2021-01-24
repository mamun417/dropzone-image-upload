<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DropzoneController extends Controller
{
    public function list()
    {
        return view('welcome');
    }

    public function add()
    {
        return view('welcome2');
    }

    public function upload(Request $request)
    {
        dd($request->all());

        $request->validate([
            'name' => 'required'
        ]);

        info($request->all());
        dd($request->all());
    }
}

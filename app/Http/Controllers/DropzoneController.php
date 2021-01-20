<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DropzoneController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        info($request->all());
        dd($request->all());
    }
}

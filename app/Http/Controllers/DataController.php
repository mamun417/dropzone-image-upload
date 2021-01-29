<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\FileHandler;
use App\Http\Requests\DataRequest;
use App\Models\Data;
use App\Models\Image;
use DB;

class DataController extends Controller
{
    public function index()
    {
        $all_data = Data::latest()->get();
        return view('index', compact('all_data'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(DataRequest $request): \Illuminate\Http\JsonResponse
    {
        DB::beginTransaction();

        try {
            $request_data = $request->validated();

            $data = Data::create($request_data);

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $image_path = FileHandler::upload($file, 'data', ['width' => 300, 'height' => 300]);

                    $data->images()->create([
                        'url' => $image_path
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'redirect_url' => route('data.edit', $data->id)
            ]);

        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();

            return response()->json([
                'error', $exception->getMessage()
            ], 500);
        }
    }

    public function edit(Data $data)
    {
        return view('edit', compact('data'));
    }

    public function imageRemove($image_id)
    {
        $image = Image::find($image_id);
        $image->delete();

        return response()->json($image);
    }
}

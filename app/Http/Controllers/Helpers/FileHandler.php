<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileHandler
{
    public static function upload($image, $path, $size = null, $prefix = null): string
    {
        $prefix = isset($prefix) ? $prefix : time();

        $image_name = $prefix . '-' . $size['width'] . 'x' . $size['height'] . '-' . $image->getClientOriginalName();

        // check is it image or file
        if (explode('/', $image->getClientMimeType())[0] !== 'image') {
            return self::fileUpload("uploads/$path", $image, $image_name);
        }

        $image_path = "uploads/$path/$image_name";

        $resized_image = Image::make($image)->resize($size['width'], $size['height'])->stream();

        Storage::put($image_path, $resized_image);

        return Storage::url($image_path);
    }

    public static function delete($path)
    {
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
    }

    private static function fileUpload($path, $image, $image_name): string
    {
        Storage::putFileAs($path, $image, $image_name);
        return Storage::url("$path/$image_name");
    }
}

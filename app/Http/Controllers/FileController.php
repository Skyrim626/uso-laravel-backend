<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    /**
     * Summary of uploadFile: A public function that uploads a file to the local storage
     * @param \Illuminate\Http\Request $request
     * @param string $key
     * @param string $path
     * @param string $options
     * @return bool|string
     */
    public function uploadFile(Request $request, String $key, String $path, String $options)
    {

        // Upload the image to the storage and get the path
        $path = $request->file($key)->store($path, $options); // Save in "storage/app/public/elections"

        // Generate the full URL to the stored file
        $url = Storage::url($path);

        // Log::info($url);

        return $url;
    }

    /**
     * Summary of uploadImage: A public function that uploads an Image
     * @param mixed $image
     * @param string $key
     * @param string $path
     * @param string $options
     * @return string
     */
    public function uploadImage($image, String $key, String $path, String $options)
{

    // Log::info($image);

    // Upload the image to the storage and get the path
    $path = $image[$key]->store($path, $options); // Save in "storage/app/public/merchandises"

    // Generate the full URL to the stored file
    $url = Storage::url($path);

    // Log::info($url);

    return $url;
}
}

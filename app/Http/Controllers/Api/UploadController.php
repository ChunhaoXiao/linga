<?php
/*
 * @Description:
 * @Version: 1.0
 * @Autor: Xiao
 * @Date: 2021-01-10 22:17:16
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadRequest;
use Image;

class UploadController extends Controller
{
    public function store(UploadRequest $request)
    {
        $file = $request->file->store('uploadss');
        $img = Image::make(asset('storage/'.$file))->fit(200);
        $fileInfo = pathinfo($file);
        $img->save(storage_path('app/public/uploadss/'.$fileInfo['filename'].'_thumb'.'.'.$fileInfo['extension']));

        return response()->json(['url' => asset('storage/'.$file), 'savepath' => $file]);
    }
}

<?php
/*
 * @Description: 
 * @Version: 1.0
 * @Autor: Xiao
 * @Date: 2021-01-10 22:17:16
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UploadRequest;

class UploadController extends Controller
{
    public function store(UploadRequest $request) {
        $file = $request->file->store('uploads');
        return response()->json(['url' => asset('storage/'.$file), 'savepath' => $file]);
    }
}

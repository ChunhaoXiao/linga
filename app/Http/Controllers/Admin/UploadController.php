<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request) {
        
        $file = $request->file('file')->store('uploads');
        
        return response()->json([
            'success' => true,
            'src' => asset('storage/'.$file),
            'ext' => $request->file('file')->extension(),
            'savepath' => $file,
        ]);
   }
}

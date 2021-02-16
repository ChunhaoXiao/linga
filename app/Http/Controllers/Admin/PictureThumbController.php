<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Image;
use Storage;

class PictureThumbController extends Controller
{
    public function store()
    {
        $files = session('files', null);
        if (empty($files)) {
            $allFiles = Storage::allFiles('pictures');
            foreach ($allFiles as $v) {
                $info = pathinfo($v);
                if (in_array($info['extension'], ['jpg', 'jpeg'])) {
                    $files[] = $v;
                }
            }
            session(['files' => $files]);
        }
        $index = request()->index ?? 0;
        if (isset($files[$index])) {
            $f = $files[$index];
            $info = pathinfo($f);
            $fname = $info['filename'].'_thumb.'.$info['extension'];
            $image = Image::make(asset('storage/'.$f))->fit(200);
            $image->save(storage_path('app/public/'.$info['dirname'].'/'.$fname));
            echo '生成成功';
            $i = $index + 1;

            $url = route('admin.thumb', ['index' => $i]);

            return view('success', ['i' => $i]);
            // header('Location:'.$url);
        }

        // foreach ($files as $v) {
        //     if (in_array($info['extension'], ['jpg', 'jpeg'])) {
        //         $res[] = $v;
        //     }
        //     //dump($v);
        //     // $info = pathinfo($v);
        //     // //dump($info);
        //     // if (in_array($info['extension'], ['jpg', 'jpeg'])) {
        //     //     $fname = $info['filename'].'_thumb.'.$info['extension'];
        //     //     $image = Image::make(asset('storage/'.$v))->fit(200);
        //     //     $image->save(storage_path('app/public/'.$info['dirname'].'/'.$fname));
        //     // }
        // }
        // echo '生成成功';
        // //dump($files);
    }
}

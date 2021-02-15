<?php

namespace App\Listeners;

use App\Events\PostSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SavePictures
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PostSaved  $event
     * @return void
     */
    public function handle(PostSaved $event)
    {
        $post = $event->post;
        $files = $post->postFiles;
        $existFiles = $post->files->pluck('path')->toArray()??[];
        $added_files = array_diff($files, $existFiles)??[];
        $deleted_files = array_diff($existFiles, $files)??[];

        if(!empty($added_files)) {
            $datas = array_map(function($item){return ['path' => $item];}, $added_files);
            $post->files()->createMany($datas);
        }
        if(!empty($deleted_files)) {
            $post->files()->whereIn('path', $deleted_files)->delete();
        }
    }
}

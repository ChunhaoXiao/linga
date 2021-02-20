<?php

namespace App\Http\Middleware;

use App\Models\Config;
use Closure;
use Illuminate\Http\Request;

class AddDataToResponse
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        //$extra = array_filter(config('extra'));
        //$extra = ['share' => '私信投稿'];
        $data = Config::first()->send_extra_data ?? 0;
        if ($data) {
            $content = json_decode($response->content(), true) ?? [];
            $response->setContent(json_encode(array_merge($content, ['share' => $data])));
        }

        return $response;
    }
}

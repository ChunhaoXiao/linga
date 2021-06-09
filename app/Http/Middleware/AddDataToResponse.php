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
        $config = Config::first();
        if (!$config->review_mode) {
            $content = json_decode($response->content(), true) ?? [];
            $response->setContent(json_encode(array_merge($content, [
                'share' => $config->share_text,
                'charge' => '加入V 组用户',
                'extra' => '加入V',
                'buy_address' => $config->buy_address,
            ])));
        }

        return $response;
    }
}

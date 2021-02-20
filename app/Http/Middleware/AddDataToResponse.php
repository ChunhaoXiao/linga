<?php

namespace App\Http\Middleware;

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
        $extra = array_filter(config('extra'));
        if (!empty($extra)) {
            $content = json_decode($response->content(), true) ?? [];
            $response->setContent(json_encode(array_merge($content, $extra)));
        }

        return $response;
    }
}

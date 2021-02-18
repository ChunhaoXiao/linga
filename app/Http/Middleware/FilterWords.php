<?php

namespace App\Http\Middleware;

use App\Models\Word;
use Closure;
use DfaFilter\SensitiveHelper;
use Illuminate\Http\Request;

class FilterWords
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('post')) {
            $words = Word::pluck('name');
            $handle = SensitiveHelper::init()->setTree($words);
            foreach (['body', 'title'] as $v) {
                $content = $request->$v ?? '';
                if ($content) {
                    $request->merge([
                        $v => $handle->replace($request->$v, '*', true),
                    ]);
                }
            }
            //$datas['body'] = $handle->replace($datas['body'], '*', true);
        }

        return $next($request);
    }
}

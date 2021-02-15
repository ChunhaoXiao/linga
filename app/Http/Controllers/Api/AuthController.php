<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class AuthController extends Controller
{
    public function store(Request $request) {
        $code = $request->code;
        $appid = 'wxfc7be91a6ccf835c';
        $secret = '175ee82c9f15ebcec7f3642562ab2232';
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=".$appid."&secret=".$secret."&js_code=".$code."&grant_type=authorization_code";
        $res = Http::withOptions(['verify' => false])->get($url);
        $openid = $res->json()['openid'];
        $user = User::firstOrCreate(['open_id' => $openid], ['open_id' => $openid]);
        return response()->json(['token' => $user->createToken("auth token")->accessToken]);
        //return response()->json(['oid' => $openid]);
        
        
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Api\UserRequest;

class UsersController extends Controller
{
    //
    public function store(UserRequest $request)
    {
        //获取缓存的内容
        $verifyData = \Cache::get($request->verification_key);

        if(!$verifyData){
            return $this->response->error('验证码已失效', 422);
        }

        if(!hash_equals($verifyData['code'],$request->verification_code)){
            //返回401
            return $this->response->errorUnauthorized('验证码错误');
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $verifyData['phone'],
            'password' => bcrypt($request->password),
        ]);

        //清除验证码缓存
        \Cache::forget($request->verification_key);

        return $this->response->created();

    }
}

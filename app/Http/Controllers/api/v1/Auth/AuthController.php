<?php

namespace App\Http\Controllers\api\v1\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Controllers\Api\v1\Controller;

class AuthController extends Controller
{
    public function register(AuthRegisterRequest $request)
    {
        $data = $request->all();
        $data['password'] =bcrypt($request->password);

        $user = User::create($data);
        return response()->json(['success' => true, 'message'=> 'usuario registrado con exito',
        'data' => $user
    ]);
}
public function login(LoginRequest $request)
{
    $credentials =$request->only('email', 'password');
    if (!$token = JWTAuth::attempt($credentials)) {
        return response()->json(['success' => false, 'message' =>'credenciales invalidas'], Response::HTTP_UNAUTHORIZED);
    }

    $user = User::select('name', 'email')->where('email', $request->email)->first();

    return response()->json(['success' => true, 'data' => $user, 'token' => $token]);
}
public function me()
{
return response()->json(['success' => true, 'data' => Auth::user()]);
}


public function logout()
{
    Auth::logout();

    return response()->json(['success' => true, 'message' => 'sesion cerrada con exito']);
}
}


<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Interfaces\IAuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private IAuthService $authService;
    public function __construct(IAuthService $authService){
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
       $data = $request->validated();

       $token = $this->authService->login($data['phone'], $data['password']);

       return sendSuccessResponse(message: 'تم تسجيل الدخول', data: $token);
    }

    public function logout(Request $request)
    {
        $this->authService->logout();
        return sendSuccessResponse(message: 'تم تسجيل الخروج');
    }
}

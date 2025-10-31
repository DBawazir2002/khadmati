<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Interfaces\IAuthService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private IAuthService $authService;
    public function __construct(IAuthService $authService){
        $this->authService = $authService;
    }

    public function __invoke(LoginRequest $request)
    {
       $data = $request->validated();

       $token = $this->authService->login($data['phone'], $data['password']);

       return sendSuccessResponse(message: 'تم تسجيل الدخول', data: $token);
    }
}

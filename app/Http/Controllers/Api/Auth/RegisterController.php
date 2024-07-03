<?php

namespace App\Http\Controllers\Api\Auth;

use App\Service\AuthService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\SuccessResponseResource;

class RegisterController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ];

        $tokenResult = $this->authService->register($data);

        return SuccessResponseResource::jsonResponse(
            'Successfully Register User!', 201, [
                'token' => $tokenResult->plainTextToken,
            ]
        );
    }
}

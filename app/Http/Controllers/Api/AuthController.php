<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Handel Login Action
     *
     * @param Request $request
     * @param AuthService $service
     * @return JsonResponse
     */
    public function login(Request $request, AuthService $service): JsonResponse
    {
        $this->data = $service->login($request->collect());
        return response()->json($this->data, $this->data['status_code']);
    }

    /**
     * Handel Register Action
     *
     * @param Request $request
     * @param AuthService $service
     * @return JsonResponse
     */
    public function register(Request $request, AuthService $service): JsonResponse
    {
        $this->data = $service->register($request->collect());
        return response()->json($this->data, $this->data['status_code']);
    }

    /**
     * Handel Logout Action
     *
     * @param AuthService $service
     * @return JsonResponse
     */
    public function logout(AuthService $service): JsonResponse
    {
        $this->data = $service->logout();
        return response()->json($this->data, $this->data['status_code']);
    }

}

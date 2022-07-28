<?php

namespace App\Services\Api;

use Exception;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Support\Collection;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

final class AuthService extends BaseService
{
    /**
     * Register new User
     *
     * @param Collection $request
     * @return array
     */
    public function register(Collection $request): array
    {
        $validator = Validator::make($request->toArray(), [
            "name" => ["required", "string", "min:6", "max:254"],
            "email" => ["required", "email", "unique:users,email"],
            "phone_number" => ["required", "numeric", "unique:users,phone_number"],
            "password" => ["required", "min:6", "max:254", "confirmed"]
        ]);

        if ($validator->fails())
            return $this->failedResponse(statusCode: 422, errors: $validator->errors()->toArray());

        try {
            $user = new User();
            $user->setName((string)$request->get("name"))
                ->setEmail((string)$request->get("email"))
                ->setPassword((string)$request->get("password"))
                ->setPhoneNumber((string)$request->get("phone_number"))
                ->setPartner(null)
                ->save();

            return $this->successResponse(data: [
                'message' => trans('api_responses.messages.success.user.create'),
                "user" => new UserResource(User::where('email', $request->get('email'))->first())
            ]);
        } catch (Exception $e) {
            return $this->failedWithExceptionResponse(500, exception: $e);
        }
    }

    /**
     * Login user
     *
     * @param Collection $request
     * @return array
     */
    public function login(Collection $request): array
    {
        $validator = Validator::make($request->toArray(), [
            "email" => ["required", "email"],
            "password" => ["required", "min:6", "max:254"]
        ]);

        if ($validator->fails())
            return $this->failedResponse(statusCode: 422, errors: $validator->errors()->toArray());

        $user = User::where('email', $request->get("email"))->first();

        if (!$user || !Hash::check($request->get("password"), $user->getPassword())) {
            return $this->failedResponse(statusCode: 401, errors: [
                "error" => __("api_responses.messages.failed.user.login")
            ]);
        }

        return $this->successResponse(data: [
            'message' => trans('api_responses.messages.success.user.login'),
            "user" => new UserResource($user)
        ]);
    }

    /**
     * Logout User
     *
     * @return array
     */
    public function logout(): array
    {
        auth()->user()->tokens()->delete();

        return $this->successResponse(data: [
            'message' => trans('api_responses.messages.success.user.logout'),
        ]);
    }
}

<?php

namespace App\Services\Api;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

final class ParentService extends BaseService
{
    /**
     * Create new partner
     *
     * @param Collection $request
     * @return array
     */
    public function createPartner(Collection $request): array
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
                ->setPartner(auth()->user()->id)
                ->save();

            return $this->successResponse(data: ['message' => trans('api_responses.messages.success.parent.create')]);
        } catch (Exception $e) {
            return $this->failedWithExceptionResponse(exception: $e);
        }
    }

    /**
     * Get User partner
     *
     * @return array
     */
    public function getPartner(): array
    {
        return $this->successResponse(data: [
            "partner" => new UserResource(auth()->user()->getPartner())
        ]);
    }
}

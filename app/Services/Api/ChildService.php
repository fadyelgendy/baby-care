<?php

namespace App\Services\Api;

use App\Http\Resources\ChildResource;
use App\Models\Api\Child;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

final class ChildService extends BaseService
{
    /**
     * Get All Children
     *
     * @return array
     */
    public function list(): array
    {
        $children = [];

        $children[] = auth()->user()->getChildren()->map(function ($child) {
            return new ChildResource($child);
        });

        if (auth()->user()->getPartner()) {
            $children[] = auth()->user()->getPartner()->getChildren()->map(function ($child) {
                return new ChildResource($child);
            });
        }

        return $this->successResponse(data: [
            "children" => $children
        ]);
    }

    /**
     * Get a child
     *
     * @param integer $id
     * @return array
     */
    public function get(int $id): array
    {
        $partnerId = 0;
        if (auth()->user()->getPartner())
            $partnerId = auth()->user()->getPartner()->getId();

        $child = Child::whereIn("parent_id", [
            auth()->id(),
            $partnerId
        ])->where("id", $id)->first();

        if (!$child)
            return $this->failedResponse(404, ['error' => trans('api_responses.messages.failed.child.not_found')]);

        return $this->successResponse(data: [
            "child" => new ChildResource($child)
        ]);
    }

    /**
     * Create new Child
     *
     * @param Collection $request
     * @return array
     */
    public function create(Collection $request): array
    {
        $validator = Validator::make($request->toArray(), [
            "name" => ["required"],
            "age" => ["required", "numeric", "gte:0"],
            "gender" => ["required"]
        ]);

        if ($validator->fails())
            return $this->failedResponse(422, $validator->errors()->toArray());

        try {
            $child = new Child();
            $child->setName(strval($request->get("name")))
                ->setGender(strval($request->get("gender")))
                ->setAge(floatval($request->get("age")))
                ->setParent(auth()->id())
                ->save();

            return $this->successResponse(data: [
                "message" => trans("api_responses.messages.success.child.create")
            ]);
        } catch (Exception $ex) {
            return $this->failedWithExceptionResponse(exception: $ex);
        }
    }

    /**
     * Update a given child
     *
     * @param integer $id
     * @param Collection $request
     * @return array
     */
    public function edit(int $id, Collection $request): array
    {
        $partnerId = 0;
        if (auth()->user()->getPartner())
            $partnerId = auth()->user()->getPartner()->getId();

        $child = Child::whereIn("parent_id", [
            auth()->id(),
            $partnerId
        ])->where("id", $id)->first();

        if (!$child)
            return $this->failedResponse(404, ['error' => trans('api_responses.messages.failed.child.not_found')]);

        try {
            if ($request->has("name") && $request->get("name") !== $child->getName())
                $child->setName(strval($request->get("name")));

            if ($request->has("gender") && $request->get("gender") !== $child->getGender())
                $child->setGender(strval($request->get("gender")));

            if ($request->has("age") && $request->get("age") !== $child->getAge())
                $child->setAge(floatval($request->get("age")));

            $child->save();

            return $this->successResponse(200, ['message' => trans('api_responses.messages.success.child.update')]);
        } catch (Exception $ex) {
            return $this->failedWithExceptionResponse(500, exception: $ex);
        }
    }

    /**
     * Delete a given child
     *
     * @param integer $id
     * @return array
     */
    public function delete(int $id): array
    {
        $child = auth()->user()->getChildren()->where("id", $id)->first();

        if (!$child)
            return $this->failedResponse(404, ['error' => trans('api_responses.messages.failed.child.not_found')]);

        if (auth()->user()->isNot($child->parent))
            return $this->failedResponse(403, ['error' => trans('api_responses.messages.failed.child.not_found')]);

        $child->delete();

        return $this->successResponse(data: ['message' => trans('api_responses.messages.success.child.delete')]);
    }
}

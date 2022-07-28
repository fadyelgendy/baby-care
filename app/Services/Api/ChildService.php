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
        $children = auth()->user()->getChildren();
        return $this->successResponse(data: [
            "children" => ChildResource::collection($children)
        ]);
    }

    /**
     * Get a child
     *
     * @param integer $id
     * @return array
     */
    public function get(int $int): array
    {
        $child = auth()->user()->getChildren()->where("id", $id)->first();

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
            $child->setName(stringValue($request->get("name")))
                ->setGender(stringValue($request->get("gender")))
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
        $child = auth()->user()->getChildren()->where("id", $id)->first();

        if (!$child)
            return $this->failedResponse(404, ['error' => trans('api_responses.messages.failed.child.not_found')]);

        $validator = Validator::make($request->toArray(), [
            "name" => ["required"],
            "age" => ["required", "numeric", "gte:0"],
            "gender" => ["required"]
        ]);

        if ($validator->fails())
            return $this->failedResponse(422, $validator->errors()->toArray());

        try {
            if ($request->get("name") !== $child->getName())
                $child->set(stringValue($request->get("name")));

            if ($request->get("gender") !== $child->getGender())
                $child->set(stringValue($request->get("gender")));

            if ($request->get("age") !== $child->getAge())
                $child->set(floatValue($request->get("age")));
            
            $child->save();

            return $this->successResponse(200, ['message' => trans('api_responses.messages.success.child.update')]);

        } catch (Exception $ex) {
            return $this->failedWithExceptionResponse(exception: $ex);
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
            return $this->failedResponse(403, ['error' => trans('api_responses.messages.failed.child.not_belong')]);

        $child->delete();

        return $this->successResponse(data:['message' => trans('api_responses.messages.success.child.delete')]);
    }
}

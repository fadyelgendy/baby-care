<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\ChildService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    /**
     * Get Chilfren List [the ones added by user, the ones added by his partner]
     *
     * @param ChildService $childService
     * @return JsonResponse
     */
    public function list(ChildService $childService): JsonResponse
    {
        $this->data = $childService->list();
        return response()->json($this->data, $this->data['status_code']);
    }

    /**
     * Get Children List [the ones added by user, the ones added by his partner]
     *
     * @param Request $request
     * @param ChildService $childService
     * @return JsonResponse
     */
    public function create(Request $request, ChildService $childService): JsonResponse
    {
        $this->data = $childService->create($request->collect());
        return response()->json($this->data, $this->data['status_code']);
    }

    /**
     * Get child by it's ID
     *
     * @param int $id
     * @param ChildService $childService
     * @return JsonResponse
     */
    public function show(int $id, ChildService $childService): JsonResponse
    {
        $this->data = $childService->get($id);
        return response()->json($this->data, $this->data['status_code']);
    }

    /**
     * Get child by it's ID
     *
     * @param int $id
     * @param Request $$request
     * @param ChildService $childService
     * @return JsonResponse
     */
    public function edit(int $id, Request $request, ChildService $childService): JsonResponse
    {
        $this->data = $childService->edit($id, $request->collect());
        return response()->json($this->data, $this->data['status_code']);
    }

    /**
     * Get child by it's ID
     *
     * @param int $id
     * @param ChildService $childService
     * @return JsonResponse
     */
    public function delete(int $id, ChildService $childService): JsonResponse
    {
        $this->data = $childService->delete($id);
        return response()->json($this->data, $this->data['status_code']);
    }
}

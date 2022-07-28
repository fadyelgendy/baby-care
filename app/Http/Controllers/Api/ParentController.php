<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\Api\ParentService;
use App\Http\Controllers\Controller;

class ParentController extends Controller
{
    /**
     * Get user partner
     *
     * @param ParentService $parentService
     * @return JsonResponse
     */
    public function getPartner(ParentService $parentService): JsonResponse
    {
        $this->data = $parentService->getPartner();
        return response()->json($this->data, $this->data['status_code']);
    }

    /**
     * Get user partner
     *
     * @param Request $request
     * @param ParentService $parentService
     * @return JsonResponse
     */
    public function createPartner(Request $request, ParentService $parentService): JsonResponse
    {
        $this->data = $parentService->createPartner($request->collect());
        return response()->json($this->data, $this->data['status_code']);
    }
}

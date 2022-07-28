<?php

namespace App\Services;

use Throwable;

abstract class BaseService
{
    protected array $data;

    /**
     * Handle Success Response
     *
     * @param integer $statusCode
     * @param array $data
     * @return array
     */
    public function successResponse(int $statusCode = 200, array $data = []): array
    {
        return [
            "success" => true,
            "status_code" => $statusCode,
            "data" => $data
        ];
    }

    /**
     * Handle Failed Response
     *
     * @param integer $statusCode
     * @param array $errors
     * @return array
     */
    public function failedResponse(int $statusCode = 400, array $errors = []): array
    {
        return [
            "success" => false,
            "status_code" => $statusCode,
            "errors" => $errors
        ];
    }

    /**
     * Handle Failed with exceptions Response
     *
     * @param integer $statusCode
     * @param Throwable $exception
     * @return array
     */
    public function failedWithExceptionResponse(int $statusCode = 500, Throwable $exception): array
    {
        return [
            "success" => false,
            "status_code" => $statusCode,
            "exception" => [
                "message" => trans("api_responses.messages.failed.general.server_error"),
                "file" => $exception->getFile(),
                "line" => $exception->getLine()
            ]
        ];
    }
}
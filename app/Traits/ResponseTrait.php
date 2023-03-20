<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ResponseTrait
{
    public function response(string $message, mixed $data = '', int $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'message'       =>  $message,
            'data'          =>  $data,
        ], $code);
    }

    public function error(string $message, int $code = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], $code);
    }
}

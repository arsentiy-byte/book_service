<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Handlers\GetBookInfoHandler;
use App\Http\Requests\BookInfoRequest;
use App\Http\Resources\BookInfoResource;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

final class BookController extends Controller
{
    /**
     * @OA\Post(
     *     summary="Get Book Information",
     *     path="/books/info",
     *     operationId="bookInfo",
     *     tags={"books"},
     *     description="Returns book information",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/BookInfoRequest")
     *         )
     *     ),
     *     security={{"passport": {}}},
     *     @OA\Response(
     *          response=200,
     *          description="Book information is successfully returned.",
     *          @OA\JsonContent(ref="#/components/schemas/BookInfoResource"),
     *     )
     * )
     */
    public function info(BookInfoRequest $request, GetBookInfoHandler $handler): JsonResponse
    {
        $collection = $handler->handle($request->getData());

        return $this->response(
            'Book information is successfully returned.',
            BookInfoResource::collection($collection)
        );
    }
}

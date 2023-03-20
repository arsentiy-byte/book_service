<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\ValueObject\BookInfoVO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     @OA\Property(
 *          property="name",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="description",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="createdAt",
 *          type="date"
 *     ),
 *     @OA\Property(
 *          property="title",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="descr",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="author",
 *          type="string"
 *     )
 * )
 * @mixin BookInfoVO
 */
final class BookInfoResource extends JsonResource
{
    /**
     * @param Request $request
     */
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'createdAt' => $this->createdAt->toDateString(),
            'title' => $this->title,
            'descr' => $this->descr,
            'author' => $this->author,
        ];
    }
}

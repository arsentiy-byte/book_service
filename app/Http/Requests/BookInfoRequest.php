<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     required={"data"},
 *     @OA\Property(
 *          property="data",
 *          type="array",
 *          @OA\Items(
 *              type="object",
 *              @OA\Property(
 *                  property="name",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="description",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="createdAt",
 *                  type="date"
 *              ),
 *              @OA\Property(
 *                  property="title",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="descr",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="author",
 *                  type="string"
 *              )
 *          )
 *     )
 * )
 */
final class BookInfoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'data' => 'required|array',
            'data.*.name' => 'required|string',
            'data.*.description' => 'required|string',
            'data.*.createdAt' => 'required|date',
            'data.*.title' => 'required|string',
            'data.*.descr' => 'required|string',
            'data.*.author' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function getData(): array
    {
        return $this->validated('data');
    }
}

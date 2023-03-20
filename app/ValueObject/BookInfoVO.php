<?php

declare(strict_types=1);

namespace App\ValueObject;

use Carbon\CarbonImmutable;
use Illuminate\Support\Arr;

final class BookInfoVO
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly CarbonImmutable $createdAt,
        public readonly string $title,
        public readonly string $descr,
        public readonly string $author
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            Arr::get($data, 'name'),
            Arr::get($data, 'description'),
            CarbonImmutable::parse(Arr::get($data, 'createdAt')),
            Arr::get($data, 'title'),
            Arr::get($data, 'descr'),
            Arr::get($data, 'author')
        );
    }
}

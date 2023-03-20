<?php

declare(strict_types=1);

namespace App\Collections;

use App\ValueObject\BookInfoVO;
use Illuminate\Support\Collection;
use RuntimeException;

final class BookInfoCollection extends Collection
{
    /**
     * @param array $items
     */
    public static function make($items = []): self
    {
        $self = new self();

        foreach ($items as $item) {
            $self->add(BookInfoVO::fromArray($item));
        }

        return $self;
    }

    /**
     * @param BookInfoVO $item
     */
    public function add($item): self
    {
        if (! $item instanceof BookInfoVO) {
            throw new RuntimeException('An item must be of type BookInfoVO');
        }

        return parent::add($item);
    }
}

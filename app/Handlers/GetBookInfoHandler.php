<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Collections\BookInfoCollection;

final class GetBookInfoHandler
{
    public function handle(array $data): BookInfoCollection
    {
        return BookInfoCollection::make($data);
    }
}

<?php

declare(strict_types=1);

namespace Tests\Unit\Handlers;

use App\Handlers\GetBookInfoHandler;
use Tests\TestCase;

final class GetBookInfoHandlerTest extends TestCase
{
    private readonly GetBookInfoHandler $handler;

    public function setUp(): void
    {
        parent::setUp();

        $this->handler = $this->app->make(GetBookInfoHandler::class);
    }

    public function testHandle(): void
    {
        $input = [
            [
                'name' => $this->faker->sentence,
                'description' => $this->faker->text,
                'createdAt' => $this->faker->date,
                'title' => $this->faker->sentence,
                'descr' => $this->faker->text,
                'author' => $this->faker->name,
            ],
        ];

        $collection = $this->handler->handle($input);

        $this->assertCount(1, $collection);
    }
}

<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

final class BookControllerTest extends TestCase
{
    public function testInfo(): void
    {
        $payload = [
            'data' => [
                [
                    'name' => $this->faker->sentence,
                    'description' => $this->faker->text,
                    'createdAt' => $this->faker->date,
                    'title' => $this->faker->sentence,
                    'descr' => $this->faker->text,
                    'author' => $this->faker->name,
                ],
            ],
        ];

        $response = $this->post('/books/info', $payload);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
            'data' => [
                '*' => [
                    'name',
                    'description',
                    'createdAt',
                    'title',
                    'descr',
                    'author',
                ],
            ],
        ]);
    }
}

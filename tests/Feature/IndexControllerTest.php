<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

final class IndexControllerTest extends TestCase
{
    public function testIndex(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertJsonStructure(['message']);
    }
}

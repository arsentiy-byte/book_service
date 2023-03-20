<?php

declare(strict_types=1);

namespace Tests;

use Exception;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;

/**
 * @mixin DatabaseMigrations
 */
trait CreatesApplication
{
    public function createApplication(): Application
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * @throws Exception
     */
    private function validateDatabase(): void
    {
        if (DB::getDefaultConnection() !== 'sqlite') {
            throw new Exception(sprintf('Wrong testing database: %s', DB::getDefaultConnection()));
        }
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->runDatabaseMigrations();
        $this->seed();
    }
}

<?php

namespace Tests;

use Illuminate\Support\Facades\Artisan;

class AppTestCase extends \Illuminate\Foundation\Testing\TestCase
{

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
        $this->clearCache();
        return $app;
    }

    protected function clearCache()
    {
        $commands = ['clear-compiled', 'cache:clear', 'view:clear', 'config:clear', 'route:clear'];
        foreach ($commands as $command) {
            Artisan::call($command);
        }
    }

    public function setUp() : void
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    public function tearDown() : void
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }
}

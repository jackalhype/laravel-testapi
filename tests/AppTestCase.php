<?php

namespace Tests;

use Illuminate\Support\Facades\Artisan;

class AppTestCase extends \Illuminate\Foundation\Testing\TestCase
{
    /**
     * @var bool repeat var in sibling class, and override prepare() method to called once
     */
    protected static bool $initialized;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        static::$initialized = false;
    }

    /**
     * get/set $initialized
     */
    public function inited($val=null) : bool {
        if (null === $val) {
            return static::$initialized;
        }
        return static::$initialized = $val;
    }

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
        Artisan::call('migrate:refresh');
        Artisan::call('migrate');
        parent::beforeApplicationDestroyed(function() {
            //
        });
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
        if ($this->inited()) return;
        $this->prepare();
        $this->inited(true);
    }

    /**
     * override in Test, to execute once for all tests in Class
     */
    public function prepare() : void
    {
    }
}

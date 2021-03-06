<?php

namespace Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class AppTestCase extends \Illuminate\Foundation\Testing\TestCase
{
    /**
     * @var bool repeat var in sibling class, and override prepare() method to called once
     */
    protected static bool $initialized;

    protected static bool $once_migrated;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        static::$initialized = false;
        self::$once_migrated = false;
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
        if ($this->somehowNotTestDb()) {
            die("not sure why, but we running real db instead of test one. Exit.\n");
        }
        $this->clearCache();
        parent::beforeApplicationDestroyed(function() {

        });
        return $app;
    }

    protected function somehowNotTestDb() : bool
    {
        $con = DB::connection();
        return 'db_test' !== $con->getConfig()['host'];
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
        if (!self::$once_migrated) {
            Artisan::call('migrate:refresh');
            self::$once_migrated = true;
        }
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

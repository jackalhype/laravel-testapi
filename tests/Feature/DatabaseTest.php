<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\AppTestCase;

class DatabaseTest extends AppTestCase
{
    public function testUsingDbTest() : void
    {
        $con = DB::connection();
        $db_cons = config('database.connections');
        $defult = config('database.default');
        $this->assertEquals('db_test', $con->getConfig()['host']);
    }
}

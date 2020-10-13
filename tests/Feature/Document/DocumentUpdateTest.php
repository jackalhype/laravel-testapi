<?php

namespace Tests\Feature\Document;

use App\Models\Document;
use Tests\AppTestCase;

class DocumentUpdateTest extends AppTestCase
{
    protected static bool $initialized;

    protected $route = '/api/v1/documents';
    protected $method = 'PATCH';
    protected Document $document;

    public function prepare() : void
    {
        echo "PREPARE /n";
    }

    public function testUpdate() {
        echo " UPDATE /n";
        $this->assertEquals(1, 1);
    }

    public function testAuth()
    {
        echo " AUTH /n";
        $this->assertEquals(1, 1);
    }

//    public function updateDataProvider() : array
//    {
//        return [
//
//        ];
//    }
}

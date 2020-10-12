<?php

namespace Tests\Feature\Document;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\AppTestCase;

class DocumentStoreTest extends AppTestCase
{
    use RefreshDatabase;

    protected $route = '/api/v1/documents';
    protected $method = 'POST';

    public function testStore() : void
    {
        $this->withoutExceptionHandling();

        $response = $this->json($this->method, $this->route, [
            'payload' => ['time' => 'to make', 'some' => 'bigger things']
        ]);
        $c = $response->content();

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DocumentStoreTest extends TestCase
{
    use RefreshDatabase;

    protected $route = '/api/v1/document';
    protected $method = 'POST';

    public function testStore() : void
    {
        $this->withoutExceptionHandling();

        $response = $this->json($this->method, $this->route, [
            'payload' => ['time' => 'to make', 'some' => 'bigger things']
        ]);

        $response->assertStatus(200);
    }
}

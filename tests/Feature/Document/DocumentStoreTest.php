<?php

namespace Tests\Feature\Document;

use Tests\AppTestCase;

class DocumentStoreTest extends AppTestCase
{
    protected $route = '/api/v1/documents';
    protected $method = 'POST';

    /**
     * @dataProvider storeDataProvider
     */
    public function testStore($data) : void
    {
        $this->withoutExceptionHandling();

        $response = $this->json($this->method, $this->route, $data);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'document' => [
                    'id',
                    'status',
                    'payload',
                    'createAt',
                    'modifyAt',
                ]
            ]);
    }

    public function storeDataProvider() : array
    {
        return [
            [ [ 'payload' => ['time' => 'to make', 'some' => 'bigger things'] ] ],
            [ [] ],
        ];
    }
}

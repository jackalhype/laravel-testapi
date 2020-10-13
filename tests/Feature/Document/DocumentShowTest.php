<?php

namespace Tests\Feature\Document;

use App\Enums\DocumentStatus;
use App\Models\Document;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\AppTestCase;

class DocumentShowTest extends AppTestCase
{
    protected static bool $initialized;

    protected $route = '/api/v1/documents';
    protected $method = 'GET';
    protected Document $document;
    protected static string $document_id;

    /**
     * @dataProvider showDataProvider
     */
    public function testPublish($data, $jsonFragment)
    {
        $this->withoutExceptionHandling();
        $this->document = Document::factory()->create($data);

        $response = $this->json($this->method, $this->route . '/' . $this->document->id);
        $response->assertStatus(200)
            ->assertJsonStructure([
            'document' => [
                'id',
                'status',
                'payload',
                'createAt',
                'modifyAt',
            ]
        ])->assertJsonFragment($jsonFragment);
    }

    public function showDataProvider() : array
    {
        return [
            '1st show' => [
                'data' => [
                    'payload' => [ '1st' => 'test' ]
                ],
                'jsonFragment' => [ '1st' => 'test' ],
            ],
            '2nd show' => [
                'data' => [
                    'payload' => [ '2nd' => 'in db' ]
                ],
                'jsonFragment' => [ '2nd' => 'in db' ],
            ],
        ];
    }
}

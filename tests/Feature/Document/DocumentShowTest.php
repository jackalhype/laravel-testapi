<?php

namespace Tests\Feature\Document;

use App\Enums\DocumentStatus;
use App\Models\Document;
use App\Models\UuidModel;
use Faker\Provider\Uuid;
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
    public function testShow($data, $jsonFragments)
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
        ]);
        foreach($jsonFragments as $jsonFragment) {
            $response->assertJsonFragment($jsonFragment);
        }

    }

    public function testNotFound()
    {
        $missing_id = Uuid::uuid();
        $response = $this->json($this->method, $this->route . '/' . $missing_id);
        $response->assertStatus(404);
    }

    public function showDataProvider() : array
    {
        return [
            '1st show' => [
                'data' => [
                    'payload' => [ '1st' => 'test' ]
                ],
                'jsonFragments' => [
                    [ '1st' => 'test' ],
                    [ 'status' => 'DRAFT' ],
                ],
            ],
            '2nd show' => [
                'data' => [
                    'payload' => [ '2nd' => 'in db' ]
                ],
                'jsonFragments' => [
                    [ '2nd' => 'in db' ],
                    [ 'status' => 'DRAFT' ],
                ]
            ],
        ];
    }
}

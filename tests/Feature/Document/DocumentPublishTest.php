<?php

namespace Tests\Feature\Document;

use App\Enums\DocumentStatus;
use App\Models\Document;
use Tests\AppTestCase;

class DocumentPublishTest extends AppTestCase
{
    protected static bool $initialized;

    protected $route = '/api/v1/documents';
    protected $method = 'POST';
    protected Document $document;
    protected static string $document_id;

    public function prepare(): void
    {
        if (empty(self::$document_id)) {
            $this->document = Document::factory()->make();
            $this->document->saveOrFail();
            self::$document_id = (string)$this->document->id;
        }
    }

    public function testPublish() {
        $this->withoutExceptionHandling();
        $response = $this->json($this->method, $this->route .'/'. self::$document_id .'/publish');
        $response->assertStatus(200)
            ->assertJsonStructure([
            'document' => [
                'id',
                'status',
                'payload',
                'createAt',
                'modifyAt',
            ]
        ])->assertJsonFragment(['status' => DocumentStatus::PUBLISHED]);
    }

}

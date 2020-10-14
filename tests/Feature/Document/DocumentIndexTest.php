<?php

namespace Tests\Feature\Document;

use App\Enums\DocumentStatus;
use App\Models\Document;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\AppTestCase;

class DocumentIndexTest extends AppTestCase
{
    protected static bool $initialized;

    protected $route = '/api/v1/documents';
    protected $method = 'get';
    protected Document $document;

    public function prepare(): void
    {
        $rows = $this->getDataRows();
        foreach ($rows as $row) {
            $this->document = Document::factory()->create($row);
        }
    }

    public function testIndex() : void
    {
        $this->withoutExceptionHandling();
        $response = $this->json($this->method, $this->route . '?page=1' );
//        $c = json_decode($response->content(), true);
//        print_r($c);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'document' => [
                    [
                        'id',
                        'status',
                        'payload',
                        'createAt',
                        'modifyAt',
                    ]
                ],
                'pagination' => [
                    'page',
                    'perPage',
                    'total',
                ],
            ]);
    }

    public function getDataRows() : array
    {
        $res = [];
        $last = 50;
        foreach(range(1, $last) as $k) {
            $res[] = [ 'payload' => [ "doc" => "number {$k} of {$last}" ] ];
        }
        return $res;
    }
}

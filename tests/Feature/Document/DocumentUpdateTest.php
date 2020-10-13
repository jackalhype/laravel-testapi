<?php

namespace Tests\Feature\Document;

use App\Enums\DocumentStatus;
use App\Models\Document;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\AppTestCase;

class DocumentUpdateTest extends AppTestCase
{
    protected static bool $initialized;

    protected $route = '/api/v1/documents';
    protected $method = 'PATCH';
    protected Document $document;
    protected static string $document_id;

    public function prepare() : void
    {
        if (empty(self::$document_id)) {
            $this->document = Document::factory()->make();
            $this->document->saveOrFail();
            self::$document_id = (string) $this->document->id;
        }
    }

    /**
     * @dataProvider updateDataProvider
     */
    public function testUpdate($data, $n, $jsonFragment) {
        $this->withoutExceptionHandling();
//        var_dump(self::$document_id);
        $response = $this->json($this->method, $this->route .'/'. self::$document_id, $data);
        $response->assertJsonStructure([
            'document' => [
                'id',
                'status',
                'payload' => [
                    'actor',
                    'meta',
                    'actions',
                ],
                'createAt',
                'modifyAt',
            ]
        ])->assertJsonFragment($jsonFragment);
    }

    public function updateDataProvider() : array
    {
        return [
            '1st update with actor' => [
                'data' => [
                    'document' => [
                        'payload' => [
                            "actor" => "The fox",
                            "meta" => [
                                "type" => "quick",
                                "color" => "brown"
                            ],
                            "actions" => [
                                [
                                    "action" => "jump over",
                                    "actor" => "lazy dog"
                                ]
                            ]
                        ]
                    ]
                ],
                'n' => 0,
                'jsonFragment' => [
                    "actor" => "The fox",
                    "meta" => [
                        "type" => "quick",
                        "color" => "brown"
                    ],
                ]
            ],

            '2nd update without actor' => [
                'data' => [
                    'document' => [
                        "payload" => [
                            "meta" => [
                                "type" => "cunning",
                                "color" => null
                            ],
                            "actions" => [
                                [
                                    "action" => "eat",
                                    "actor" => "blob"
                                ],
                                [
                                    "action" => "run away"
                                ]
                            ]
                        ]
                    ]
                ],
                'n' => 1,
                'jsonFragment' => [
                    "actor" => "The fox",
                    "meta" => [
                        "type" => "cunning",
                        "color" => null,
                    ],
                ]
            ],
        ];
    }
}

<?php

namespace App\Http\Services;

use App\Enums\DocumentStatus;
use App\Http\Resources\DocumentResource;
use App\Models\Document;

class DocumentUpdateService
{
    public function update(Document $document, array $data) : DocumentResource
    {
        $payload = $data['document']['payload'] ?? [];
        $doc_payload = $document->payload;
        foreach($payload as $k => $v) {
            $doc_payload[$k] = $v;
        }
        $document->payload = $doc_payload;
        $document->saveOrFail();
        return new DocumentResource($document);
    }
}

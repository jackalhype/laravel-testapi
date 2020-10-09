<?php

namespace App\Http\Services;

use App\Enums\DocumentStatus;
use App\Http\Resources\DocumentResource;
use App\Models\Document;

class DocumentStoreService
{
    public function store(array $data) : DocumentResource
    {
        $document = new Document();
        $document->payload = $data['payload'];
        $document->status = DocumentStatus::DRAFT;
        $document->saveOrFail();
        return new DocumentResource($document);
    }
}

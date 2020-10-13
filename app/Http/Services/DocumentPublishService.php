<?php

namespace App\Http\Services;

use App\Enums\DocumentStatus;
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use Illuminate\Support\Facades\DB;

class DocumentPublishService
{
    public function publish(Document $document, array $data) : DocumentResource
    {
        return DB::transaction(function() use ($document, $data) {
            $doc = Document::where('id', '=', $document->id)
                ->lockForUpdate()->first();
            $doc->status = DocumentStatus::PUBLISHED;
            $doc->saveOrFail();
            return new DocumentResource($doc);
        }, 2);
    }
}

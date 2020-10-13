<?php

namespace App\Http\Services;

use App\Enums\DocumentStatus;
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use Illuminate\Support\Facades\DB;

class DocumentUpdateService
{
    public function update(Document $document, array $data) : DocumentResource
    {
        return DB::transaction(function() use ($document, $data) {
            $doc = Document::where('id', '=', $document->id)
                ->lockForUpdate()->first();
            $payload = $data['document']['payload'] ?? [];
            $doc_payload = $doc->payload;
            foreach($payload as $k => $v) {
                $doc_payload[$k] = $v;
            }
            $doc->payload = $doc_payload;
            $doc->saveOrFail();
            return new DocumentResource($doc);
        }, 2);
    }
}

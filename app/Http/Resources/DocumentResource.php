<?php

namespace App\Http\Resources;

class DocumentResource extends AppJsonResource
{
    public static $wrap = 'document';

    public function toArray($request) : array
    {
        return [
            'id' => (string) $this->id,
            'status' => $this->status,
            'payload' => $this->payload,
            'createAt' => $this->ftime($this->created_at),
            'modifyAt' => $this->ftime($this->updated_at),
        ];
    }
}

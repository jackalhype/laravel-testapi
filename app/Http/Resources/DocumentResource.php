<?php

namespace App\Http\Resources;

use App\Enums\DocumentStatus;

/**
 * Class DocumentResource
 * @package App\Http\Resources
 *
 * @OA\Schema(
 *     description="Document Resource",
 *     type="object",
 *     title="Document Resource",
 *     properties={
 *        @OA\Property(property="id", type="string", example="6b43adfa-86cb-30ff-bb35-92f1a479d760"),
 *        @OA\Property(property="status", ref="#/components/schemas/DocumentStatus"),
 *        @OA\Property(property="payload", type="object", description="Payload json", example={"actor":"rabbit","action":"run"}),
 *        @OA\Property(property="createAt", type="string", example="2020-10-16 12:46:52 +00:00"),
 *        @OA\Property(property="modifyAt", type="string", example="2020-10-16 12:46:52 +00:00")
 *     }
 * )
 *
 * @OA\Schema(
 *     schema="DocumentResourcePublished",
 *     description="Document Resource",
 *     type="object",
 *     title="Document Resource",
 *     properties={
 *        @OA\Property(property="id", type="string", example="6b43adfa-86cb-30ff-bb35-92f1a479d760"),
 *        @OA\Property(property="status", type="string", example="PUBLISHED"),
 *        @OA\Property(property="payload", type="object", description="Payload json", example={"actor":"rabbit","action":"run"}),
 *        @OA\Property(property="createAt", type="string", example="2020-10-16 12:46:52 +00:00"),
 *        @OA\Property(property="modifyAt", type="string", example="2020-10-16 12:46:52 +00:00")
 *     }
 * )
 *
 *
 * @OA\Schema(
 *     schema="document_id",
 *     type="string",
 *     description="Uuid of the document",
 *     example="6b43adfa-86cb-30ff-bb35-92f1a479d760"
 * )
 */
class DocumentResource extends AppJsonResource
{
    public static $wrap = 'document';

    public function toArray($request) : array
    {
        return [
            'id' => (string) $this->id,
            'status' => (new DocumentStatus($this->status))->key,
            'payload' => $this->payload,
            'createAt' => $this->ftime($this->created_at),
            'modifyAt' => $this->ftime($this->updated_at),
        ];
    }
}

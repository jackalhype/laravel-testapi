<?php

namespace App\Http\Resources\Collections;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class DocumentResourceCollection
 * @package App\Http\Resources\Collections
 *
 * @OA\Schema(
 *     description="Document Resource Collection",
 *     type="object",
 *     title="Document Resource Collection",
 *     @OA\Property(
 *        property="document",
 *        type="array",
 *        @OA\Items(
 *           ref="#/components/schemas/DocumentResource"
 *        )
 *     ),
 *     @OA\Property(
 *        property="pagination",
 *        type="object",
 *        @OA\Property(property="page", type="integer", description="current page", example=1),
 *        @OA\Property(property="perPage", type="integer", description="how many items per page", example=20),
 *        @OA\Property(property="total", type="integer", description="total items", example=100500)
 *     )
 * )
 */
class DocumentResourceCollection extends ResourceCollection
{
    private array $pagination;

    public static $wrap = 'document';

    public function __construct($resource)
    {
        $this->pagination = [
            'page' => $resource->currentPage(),
            'perPage' => $resource->perPage(),
            'total' => $resource->total(),
        ];
        parent::__construct($resource);
    }

    public function toArray($request) : array
    {
        return $this->collection->toArray();
    }

    public function toResponse($request)
    {
        // no meta, links plz
        return JsonResource::toResponse($request);
    }

    /**
     * @param Request $request
     * @return array|void
     */
    public function with($request)
    {
        return [
            'pagination' => $this->pagination,
        ];
    }
}

<?php

namespace App\Http\Resources\Collections;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

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

<?php

namespace App\Http\Resources\Collections;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DocumentResourceCollection extends ResourceCollection
{
    private array $pagination;

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
        return [
            'document' => $this->collection,
            'pagination' => $this->pagination,
        ];
    }
}

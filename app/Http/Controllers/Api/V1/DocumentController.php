<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Document\DocumentIndexRequest;
use App\Http\Requests\Document\DocumentPublishRequest;
use App\Http\Requests\Document\DocumentStoreRequest;
use App\Http\Requests\Document\DocumentShowRequest;
use App\Http\Requests\Document\DocumentUpdateRequest;
use App\Http\Resources\DocumentResource;
use App\Http\Services\DocumentPublishService;
use App\Http\Services\DocumentStoreService;
use App\Http\Services\DocumentUpdateService;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DocumentIndexRequest $request) : Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DocumentStoreRequest $request, DocumentStoreService $service)
    {
        $resource = $service->store($request->validated());
        $responce = $resource->toResponse($request);
        if ($responce->getStatusCode() === 201) {
            $responce->setStatusCode(200);
        }
        return $responce;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(DocumentShowRequest $request, Document $document) : Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     */
    public function update(DocumentUpdateRequest $request,
                           Document $document,
                           DocumentUpdateService $service) : DocumentResource
    {
        return $service->update($document, $request->validated());
    }


    /**
     * Publish the Document
     *
     * @param Request $request
     * @param Document $document
     */
    public function publish(DocumentPublishRequest $request,
                            Document $document,
                            DocumentPublishService $service) : DocumentResource
    {
        return $service->publish($document, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document) : Response
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Document\DocumentIndexRequest;
use App\Http\Requests\Document\DocumentPublishRequest;
use App\Http\Requests\Document\DocumentSaveRequest;
use App\Http\Requests\Document\DocumentShowRequest;
use App\Http\Resources\DocumentResource;
use App\Http\Services\DocumentStoreService;
use App\Models\Document;
use Illuminate\Http\Request;
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
    public function store(DocumentSaveRequest $request, DocumentStoreService $service) : DocumentResource
    {
        return $service->store($request->validated());
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
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentSaveRequest $request, Document $document) : Response
    {
        //
    }


    /**
     * Publish the Document
     *
     * @param Request $request
     * @param Document $document
     */
    public function publish(DocumentPublishRequest $request, Document $document) : Response
    {

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

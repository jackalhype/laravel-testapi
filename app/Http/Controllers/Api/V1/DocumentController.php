<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Document\DocumentIndexRequest;
use App\Http\Requests\Document\DocumentPublishRequest;
use App\Http\Requests\Document\DocumentStoreRequest;
use App\Http\Requests\Document\DocumentShowRequest;
use App\Http\Requests\Document\DocumentUpdateRequest;
use App\Http\Resources\Collections\DocumentResourceCollection;
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
     * List documents
     *
     * @OA\Get(
     *     tags={"Documents"},
     *     path="/api/v1/documents?page={page}",
     *     @OA\Parameter(
     *         in="query",
     *         name="page",
     *         required=false,
     *         description="1-based page number"
     *     ),
     *     @OA\Response(
     *        response="200",
     *        description="Successful operation",
     *        @OA\JsonContent(
     *              ref="#/components/schemas/DocumentResourceCollection"
     *        ),
     *     )
     * )
     */
    public function index(DocumentIndexRequest $request)
    {
        $page = $request->get('page', 1);
        $perPage = $request->get('perPage', 20);
        $docs = Document::orderByDesc('status')
            ->orderByDesc('updated_at')
            ->paginate($perPage, ['*'],'page', $page);
        return new DocumentResourceCollection(DocumentResource::collection($docs));
    }

    /**
     * Store a newly created document
     *
     * @OA\Post(
     *     tags={"Documents"},
     *     path="/api/v1/documents",
     *     @OA\RequestBody(
     *        required=false,
     *        @OA\JsonContent(
     *            @OA\Property(
     *               property="payload",
     *               type="object",
     *               example={"actor":"rabbit","action":"run"}
     *            )
     *        )
     *     ),
     *     @OA\Response(
     *        response="200",
     *        description="Successful operation",
     *        @OA\JsonContent(
     *           @OA\Property(
     *              property="document",
     *              type="object",
     *              ref="#/components/schemas/DocumentResource"
     *           )
     *        ),
     *     )
     * )
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
     * Show the specified document
     *
     * @OA\Get(
     *     tags={"Documents"},
     *     path="/api/v1/documents/{document}",
     *     @OA\Parameter(
     *         in="path",
     *         name="document",
     *         required=true,
     *         description="uuid e.g.: 6b43adfa-86cb-30ff-bb35-92f1a479d760"
     *     ),
     *     @OA\Response(
     *        response="200",
     *        description="Successful operation",
     *        @OA\JsonContent(
     *           @OA\Property(
     *              property="document",
     *              type="object",
     *              ref="#/components/schemas/DocumentResource"
     *           )
     *        ),
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Not found"
     *     )
     * )
     */
    public function show(DocumentShowRequest $request, Document $document) : DocumentResource
    {
        return new DocumentResource($document);
    }

    /**
     * Update the specified Document
     *
     * @OA\Patch(
     *     tags={"Documents"},
     *     path="/api/v1/documents/{document}",
     *     @OA\Parameter(
     *         in="path",
     *         name="document",
     *         required=true,
     *         description="uuid e.g.: 6b43adfa-86cb-30ff-bb35-92f1a479d760"
     *     ),
     *     @OA\RequestBody(
     *        @OA\JsonContent(
     *           @OA\Property(
     *              property="document",
     *              type="object",
     *              @OA\Property(
     *                  property="payload",
     *                  type="object",
     *                  example={"actor":"hero","action":"update stuff"}
     *              )
     *           )
     *        )
     *     ),
     *     @OA\Response(
     *        response="200",
     *        description="Successful operation",
     *        @OA\JsonContent(
     *           @OA\Property(
     *              property="document",
     *              type="object",
     *              ref="#/components/schemas/DocumentResource"
     *           )
     *        ),
     *     ),
     *     @OA\Response(
     *        response="403",
     *        description="Unauthorized",
     *     )
     * )
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
     *  @OA\Post(
     *     tags={"Documents"},
     *     path="/api/v1/documents/{document}/publish",
     *     @OA\Parameter(
     *         in="path",
     *         name="document",
     *         required=true,
     *         description="uuid e.g.: 6b43adfa-86cb-30ff-bb35-92f1a479d760"
     *     ),
     *     @OA\Response(
     *        response="200",
     *        description="Successful operation",
     *        @OA\JsonContent(
     *           @OA\Property(
     *              property="document",
     *              type="object",
     *              ref="#/components/schemas/DocumentResourcePublished"
     *           )
     *        ),
     *     ),
     *     @OA\Response(
     *        response="403",
     *        description="Unauthorized",
     *     )
     *  )
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

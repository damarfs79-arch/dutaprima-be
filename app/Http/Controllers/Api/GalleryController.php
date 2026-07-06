<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use App\Services\GalleryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    protected GalleryService $service;

    public function __construct(GalleryService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): JsonResponse
    {
        if ($request->query('paginate')) {
            $perPage = (int) $request->query('per_page', 12);
            return response()->json($this->service->getPaginatedGalleries($perPage));
        }
        return response()->json($this->service->getAllGalleries());
    }

    public function store(GalleryRequest $request): JsonResponse
    {
        $data = $request->validated();
        $gallery = $this->service->createGallery($data, $request->file('image'));

        return response()->json($gallery, 201);
    }

    public function update(GalleryRequest $request, Gallery $gallery): JsonResponse
    {
        $data = $request->validated();
        $gallery = $this->service->updateGallery($gallery, $data, $request->file('image'));

        return response()->json($gallery);
    }

    public function destroy(Gallery $gallery): JsonResponse
    {
        $this->service->deleteGallery($gallery);

        return response()->json(null, 204);
    }
}

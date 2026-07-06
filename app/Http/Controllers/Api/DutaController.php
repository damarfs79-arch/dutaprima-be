<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DutaRequest;
use App\Models\Duta;
use App\Services\DutaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DutaController extends Controller
{
    protected DutaService $service;

    public function __construct(DutaService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): JsonResponse
    {
        if ($request->query('paginate')) {
            $perPage = (int) $request->query('per_page', 12);
            return response()->json($this->service->getPaginatedDutas($perPage));
        }
        return response()->json($this->service->getAllDutas());
    }

    public function store(DutaRequest $request): JsonResponse
    {
        $data = $request->validated();
        $files = [
            'photo' => $request->file('photo'),
            'photo_couple' => $request->file('photo_couple'),
            'photo_female' => $request->file('photo_female'),
        ];
        
        $duta = $this->service->createDuta($data, array_filter($files));

        return response()->json($duta, 201);
    }

    public function update(DutaRequest $request, Duta $duta): JsonResponse
    {
        $data = $request->validated();
        $files = [
            'photo' => $request->file('photo'),
            'photo_couple' => $request->file('photo_couple'),
            'photo_female' => $request->file('photo_female'),
        ];

        $updatedDuta = $this->service->updateDuta($duta, $data, array_filter($files));

        return response()->json($updatedDuta);
    }

    public function destroy(Duta $duta): JsonResponse
    {
        $this->service->deleteDuta($duta);

        return response()->json(null, 204);
    }
}

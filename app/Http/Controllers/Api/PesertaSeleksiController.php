<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PesertaSeleksiStoreRequest;
use App\Http\Requests\PesertaSeleksiUpdateRequest;
use App\Models\PesertaSeleksi;
use App\Services\PesertaSeleksiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PesertaSeleksiController extends Controller
{
    protected PesertaSeleksiService $service;

    public function __construct(PesertaSeleksiService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): JsonResponse
    {
        $status = $request->filled('status') ? $request->query('status') : null;

        return response()->json($this->service->getAll($status));
    }

    public function store(PesertaSeleksiStoreRequest $request): JsonResponse
    {
        return response()->json($this->service->create($request->validated()), 201);
    }

    public function update(PesertaSeleksiUpdateRequest $request, PesertaSeleksi $pesertaSeleksi): JsonResponse
    {
        return response()->json($this->service->update($pesertaSeleksi, $request->validated()));
    }

    public function destroy(PesertaSeleksi $pesertaSeleksi): JsonResponse
    {
        $this->service->delete($pesertaSeleksi);

        return response()->json(null, 204);
    }
}

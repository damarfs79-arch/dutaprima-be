<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PendaftaranRequest;
use App\Models\Pendaftaran;
use App\Services\PendaftaranService;
use Illuminate\Http\JsonResponse;

class PendaftaranController extends Controller
{
    protected PendaftaranService $service;

    public function __construct(PendaftaranService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->service->getAllPendaftarans());
    }

    public function store(PendaftaranRequest $request): JsonResponse
    {
        $data = $request->validated();
        $files = [
            'foto_full' => $request->file('foto_full'),
            'foto_half' => $request->file('foto_half'),
            'file_prestasi' => $request->file('file_prestasi'),
        ];
        
        $pendaftaran = $this->service->createPendaftaran($data, array_filter($files));

        return response()->json($pendaftaran, 201);
    }

    public function show(Pendaftaran $pendaftaran): JsonResponse
    {
        return response()->json($this->service->getPendaftaranWithBase64($pendaftaran));
    }

    public function destroy(Pendaftaran $pendaftaran): JsonResponse
    {
        $this->service->deletePendaftaran($pendaftaran);
        return response()->json(null, 204);
    }

    public function unreadCount(): JsonResponse
    {
        return response()->json([
            'count' => $this->service->getUnreadCount(),
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KandidatVoting;
use App\Services\KandidatVotingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KandidatVotingController extends Controller
{
    protected KandidatVotingService $service;

    public function __construct(KandidatVotingService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->service->getAll());
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'kategori'    => 'required|string|max:255',
            'popularitas' => 'required|in:Tinggi,Sedang,Meningkat,Stabil',
            'suara'       => 'required|integer|min:0',
            'foto'        => 'required|image|max:51200',
        ]);

        $kandidat = $this->service->create($validated, $request->file('foto'));

        return response()->json($kandidat, 201);
    }

    // POST bukan PUT, karena FormData (upload foto)
    public function update(Request $request, KandidatVoting $kandidatVoting): JsonResponse
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'kategori'    => 'required|string|max:255',
            'popularitas' => 'required|in:Tinggi,Sedang,Meningkat,Stabil',
            'suara'       => 'required|integer|min:0',
            'foto'        => 'nullable|image|max:51200',
        ]);

        $updated = $this->service->update($kandidatVoting, $validated, $request->file('foto'));

        return response()->json($updated);
    }

    public function destroy(KandidatVoting $kandidatVoting): JsonResponse
    {
        $this->service->delete($kandidatVoting);

        return response()->json(null, 204);
    }

    // Endpoint publik buat tombol "Vote Sekarang" di halaman Voting.vue
    public function vote(KandidatVoting $kandidatVoting): JsonResponse
    {
        $settings = app(\App\Services\SettingsService::class)->getVotingSettings();
        if (!empty($settings['end_time'])) {
            $endTime = \Carbon\Carbon::parse($settings['end_time']);
            if (now()->greaterThanOrEqualTo($endTime)) {
                return response()->json(['message' => 'Voting telah ditutup.'], 403);
            }
        }

        return response()->json($this->service->vote($kandidatVoting));
    }

    // Reset semua suara ke 0 (buat tombol "Reset Suara" di admin)
    public function reset(): JsonResponse
    {
        $this->service->resetAllVotes();

        return response()->json(['message' => 'Semua suara berhasil direset']);
    }
}

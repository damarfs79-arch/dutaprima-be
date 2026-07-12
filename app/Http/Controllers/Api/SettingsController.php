<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SettingsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    protected SettingsService $service;

    public function __construct(SettingsService $service)
    {
        $this->service = $service;
    }

    // ==================== Registration ====================

    public function registrationSettings(): JsonResponse
    {
        return response()->json($this->service->getRegistrationSettings());
    }

    public function updateRegistrationSettings(Request $request): JsonResponse
    {
        $data = $request->validate([
            'marquee_show' => 'boolean',
            'marquee_text' => 'nullable|string|max:500',
        ]);

        return response()->json($this->service->updateRegistrationSettings($data));
    }

    // ==================== Selection Flow ====================

    public function selectionFlow(): JsonResponse
    {
        return response()->json($this->service->getSelectionFlow());
    }

    public function updateSelectionFlow(Request $request): JsonResponse
    {
        $data = $request->validate([
            'steps' => 'required|array',
        ]);

        return response()->json($this->service->updateSelectionFlow($data));
    }

    // ==================== Marquee ====================

    public function marqueeSettings(): JsonResponse
    {
        return response()->json($this->service->getMarqueeSettings());
    }

    public function updateMarqueeSettings(Request $request): JsonResponse
    {
        $data = $request->validate([
            'pendaftaran_show' => 'boolean',
            'pendaftaran_text' => 'nullable|string|max:500',
            'pengumuman_show'  => 'boolean',
            'pengumuman_text'  => 'nullable|string|max:500',
            'voting_text1'     => 'nullable|string|max:500',
            'voting_text2'     => 'nullable|string|max:500',
        ]);

        return response()->json($this->service->updateMarqueeSettings($data));
    }

    // ==================== Angkatan ====================

    public function angkatanSettings(): JsonResponse
    {
        return response()->json($this->service->getAngkatanSettings());
    }

    public function updateAngkatanSettings(Request $request): JsonResponse
    {
        $data = $request->validate([
            'angkatan_list'   => 'present|array',
            'angkatan_list.*' => 'numeric',
        ]);

        return response()->json($this->service->updateAngkatanSettings($data['angkatan_list']));
    }

    // ==================== Voting ====================

    public function votingSettings(): JsonResponse
    {
        return response()->json($this->service->getVotingSettings());
    }

    public function updateVotingSettings(Request $request): JsonResponse
    {
        $data = $request->validate([
            'end_time' => 'nullable|string',
        ]);

        return response()->json($this->service->updateVotingSettings($data));
    }

}

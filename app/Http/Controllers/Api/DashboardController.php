<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Duta;
use App\Models\Gallery;
use App\Models\Pendaftaran;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function stats(): JsonResponse
    {
        return response()->json([
            'totalDuta'            => Duta::count(),
            'totalGallery'         => Gallery::count(),
            'totalRegistrations'   => Pendaftaran::count(),
            'totalVisitors'        => 0,
            'unreadRegistrations'  => Pendaftaran::where('is_read', false)->count(),
        ]);
    }
}

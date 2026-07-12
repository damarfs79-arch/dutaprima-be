<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DutaController;
use App\Http\Controllers\Api\PendaftaranController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\PesertaSeleksiController;
use App\Http\Controllers\Api\KandidatVotingController;

Route::post('/admin/login', [AuthController::class, 'login']);
Route::get('/admin/stats', [DashboardController::class, 'stats']);

Route::get('/gallery', [GalleryController::class, 'index']);
Route::post('/gallery', [GalleryController::class, 'store']);
Route::post('/gallery/{gallery}', [GalleryController::class, 'update']);
Route::delete('/gallery/{gallery}', [GalleryController::class, 'destroy']);

Route::get('/duta', [DutaController::class, 'index']);
Route::post('/duta', [DutaController::class, 'store']);
Route::post('/duta/{duta}', [DutaController::class, 'update']); // POST bukan PUT karena FormData
Route::delete('/duta/{duta}', [DutaController::class, 'destroy']);

Route::get('/settings/registration', [SettingsController::class, 'registrationSettings']);
Route::put('/settings/registration', [SettingsController::class, 'updateRegistrationSettings']);

Route::get('/settings/selection-flow', [SettingsController::class, 'selectionFlow']);
Route::put('/settings/selection-flow', [SettingsController::class, 'updateSelectionFlow']);

Route::get('/settings/marquee', [SettingsController::class, 'marqueeSettings']);
Route::put('/settings/marquee', [SettingsController::class, 'updateMarqueeSettings']);

Route::get('/settings/angkatan', [SettingsController::class, 'angkatanSettings']);
Route::put('/settings/angkatan', [SettingsController::class, 'updateAngkatanSettings']);

Route::get('/settings/voting', [SettingsController::class, 'votingSettings']);
Route::put('/settings/voting', [SettingsController::class, 'updateVotingSettings']);

Route::post('/pendaftaran', [PendaftaranController::class, 'store']);
Route::get('/pendaftaran', [PendaftaranController::class, 'index']);
Route::get('/pendaftaran/unread-count', [PendaftaranController::class, 'unreadCount']); // HARUS di atas /{pendaftaran}
Route::get('/pendaftaran/{pendaftaran}', [PendaftaranController::class, 'show']);
Route::delete('/pendaftaran/{pendaftaran}', [PendaftaranController::class, 'destroy']);

// ==================== PESERTA SELEKSI (Pengumuman Hasil Seleksi) ====================
Route::get('/peserta-seleksi', [PesertaSeleksiController::class, 'index']);
Route::post('/peserta-seleksi', [PesertaSeleksiController::class, 'store']);
Route::put('/peserta-seleksi/{pesertaSeleksi}', [PesertaSeleksiController::class, 'update']);
Route::delete('/peserta-seleksi/{pesertaSeleksi}', [PesertaSeleksiController::class, 'destroy']);

// ==================== KANDIDAT VOTING (Voting Duta Favorit) ====================
Route::get('/kandidat-voting', [KandidatVotingController::class, 'index']);
Route::post('/kandidat-voting', [KandidatVotingController::class, 'store']);
Route::post('/kandidat-voting/reset', [KandidatVotingController::class, 'reset']); // HARUS di atas /{kandidatVoting}
Route::post('/kandidat-voting/{kandidatVoting}', [KandidatVotingController::class, 'update']); // POST karena FormData
Route::delete('/kandidat-voting/{kandidatVoting}', [KandidatVotingController::class, 'destroy']);
Route::post('/kandidat-voting/{kandidatVoting}/vote', [KandidatVotingController::class, 'vote']); // dipanggil dari halaman publik


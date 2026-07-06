<?php

namespace App\Services;

use App\Models\Pendaftaran;
use App\Repositories\PendaftaranRepository;
use App\Traits\ImageOptimizer;
use Illuminate\Http\UploadedFile;

class PendaftaranService
{
    use ImageOptimizer;

    protected PendaftaranRepository $repository;

    public function __construct(PendaftaranRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllPendaftarans()
    {
        return $this->repository->getAll();
    }

    public function createPendaftaran(array $data, array $files): Pendaftaran
    {
        if (isset($files['foto_full']) && $files['foto_full'] instanceof UploadedFile) {
            $optimized = $this->optimizeImage($files['foto_full'], 'pendaftaran');
            $data['foto_full'] = $optimized['original'];
            $data['foto_full_webp'] = $optimized['webp'];
            $data['foto_full_thumb'] = $optimized['thumb'];
        }

        if (isset($files['foto_half']) && $files['foto_half'] instanceof UploadedFile) {
            $optimized = $this->optimizeImage($files['foto_half'], 'pendaftaran');
            $data['foto_half'] = $optimized['original'];
            $data['foto_half_webp'] = $optimized['webp'];
            $data['foto_half_thumb'] = $optimized['thumb'];
        }

        if (isset($files['file_prestasi']) && $files['file_prestasi'] instanceof UploadedFile) {
            $path = $files['file_prestasi']->store('pendaftaran/prestasi', 'public');
            $data['file_prestasi'] = '/storage/' . $path;
        }

        return $this->repository->create($data);
    }

    public function getPendaftaranWithBase64(Pendaftaran $pendaftaran): Pendaftaran
    {
        $this->repository->markAsRead($pendaftaran);

        $pendaftaran->foto_full_b64 = $this->urlToBase64($pendaftaran->foto_full);
        $pendaftaran->foto_half_b64 = $this->urlToBase64($pendaftaran->foto_half);
        if ($pendaftaran->file_prestasi) {
            $pendaftaran->file_prestasi_b64 = $this->urlToBase64($pendaftaran->file_prestasi);
        }

        return $pendaftaran;
    }

    public function deletePendaftaran(Pendaftaran $pendaftaran): void
    {
        $this->repository->delete($pendaftaran);
    }

    public function getUnreadCount(): int
    {
        return $this->repository->getUnreadCount();
    }

    private function urlToBase64(?string $url): ?string
    {
        if (!$url) return null;
        
        $pathParts = explode('storage/', $url);
        if (isset($pathParts[1])) {
            $filePath = storage_path('app/public/' . $pathParts[1]);
            if (file_exists($filePath)) {
                $type = pathinfo($filePath, PATHINFO_EXTENSION);
                $data = file_get_contents($filePath);
                return 'data:image/' . $type . ';base64,' . base64_encode($data);
            }
        }
        return $url;
    }
}

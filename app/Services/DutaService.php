<?php

namespace App\Services;

use App\Models\Duta;
use App\Repositories\DutaRepository;
use App\Traits\ImageOptimizer;
use Illuminate\Http\UploadedFile;

class DutaService
{
    use ImageOptimizer;

    protected DutaRepository $repository;

    public function __construct(DutaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllDutas()
    {
        return $this->repository->getAll();
    }

    public function getPaginatedDutas(int $perPage = 12)
    {
        return $this->repository->getPaginated($perPage);
    }

    public function createDuta(array $data, array $files): Duta
    {
        $data = $this->handleUploads($data, $files);
        return $this->repository->create($data);
    }

    public function updateDuta(Duta $duta, array $data, array $files): Duta
    {
        $data = $this->handleUploads($data, $files);
        
        foreach (['photo', 'photo_couple', 'photo_female'] as $field) {
            if (!isset($files[$field])) {
                unset($data[$field]);
            }
        }

        return $this->repository->update($duta, $data);
    }

    public function deleteDuta(Duta $duta): void
    {
        $this->repository->delete($duta);
    }

    protected function handleUploads(array $data, array $files): array
    {
        foreach (['photo', 'photo_couple', 'photo_female'] as $field) {
            if (isset($files[$field]) && $files[$field] instanceof UploadedFile) {
                $optimized = $this->optimizeImage($files[$field], 'dutas');
                
                $data[$field] = $optimized['original'];
                $data[$field . '_webp'] = $optimized['webp'];
                $data[$field . '_thumb'] = $optimized['thumb'];
            }
        }
        return $data;
    }
}

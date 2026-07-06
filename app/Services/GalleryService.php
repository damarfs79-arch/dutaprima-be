<?php

namespace App\Services;

use App\Models\Gallery;
use App\Repositories\GalleryRepository;
use App\Traits\ImageOptimizer;
use Illuminate\Http\UploadedFile;

class GalleryService
{
    use ImageOptimizer;

    protected GalleryRepository $repository;

    public function __construct(GalleryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllGalleries()
    {
        return $this->repository->getAll();
    }

    public function getPaginatedGalleries(int $perPage = 12)
    {
        return $this->repository->getPaginated($perPage);
    }

    public function createGallery(array $data, UploadedFile $image): Gallery
    {
        $optimized = $this->optimizeImage($image, 'galleries');
        $data['image'] = $optimized['original'];
        $data['image_webp'] = $optimized['webp'];
        $data['image_thumb'] = $optimized['thumb'];

        return $this->repository->create($data);
    }

    public function updateGallery(Gallery $gallery, array $data, ?UploadedFile $image): Gallery
    {
        if ($image) {
            $optimized = $this->optimizeImage($image, 'galleries');
            $data['image'] = $optimized['original'];
            $data['image_webp'] = $optimized['webp'];
            $data['image_thumb'] = $optimized['thumb'];
        } else {
            unset($data['image']);
        }

        return $this->repository->update($gallery, $data);
    }

    public function deleteGallery(Gallery $gallery): void
    {
        $this->repository->delete($gallery);
    }
}

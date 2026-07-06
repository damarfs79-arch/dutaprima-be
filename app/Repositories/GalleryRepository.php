<?php

namespace App\Repositories;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Collection;

class GalleryRepository
{
    public function getAll(): Collection
    {
        return Gallery::orderBy('id', 'desc')->get();
    }

    public function getPaginated(int $perPage = 12)
    {
        return Gallery::orderBy('id', 'desc')->paginate($perPage);
    }

    public function create(array $data): Gallery
    {
        return Gallery::create($data);
    }

    public function update(Gallery $gallery, array $data): Gallery
    {
        $gallery->update($data);
        return $gallery->fresh();
    }

    public function delete(Gallery $gallery): void
    {
        $gallery->delete();
    }
}

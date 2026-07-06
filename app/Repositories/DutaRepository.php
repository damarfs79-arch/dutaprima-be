<?php

namespace App\Repositories;

use App\Models\Duta;
use Illuminate\Database\Eloquent\Collection;

class DutaRepository
{
    public function getAll(): Collection
    {
        return Duta::orderBy('id', 'desc')->get();
    }

    public function getPaginated(int $perPage = 12)
    {
        return Duta::orderBy('id', 'desc')->paginate($perPage);
    }

    public function create(array $data): Duta
    {
        return Duta::create($data);
    }

    public function update(Duta $duta, array $data): Duta
    {
        $duta->update($data);
        return $duta->fresh();
    }

    public function delete(Duta $duta): void
    {
        $duta->delete();
    }
}

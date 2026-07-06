<?php

namespace App\Repositories;

use App\Models\PesertaSeleksi;
use Illuminate\Database\Eloquent\Collection;

class PesertaSeleksiRepository
{
    public function getAll(?string $status = null): Collection
    {
        $query = PesertaSeleksi::query();

        if ($status) {
            $query->where('status', $status);
        }

        return $query->orderBy('id', 'desc')->get();
    }

    public function create(array $data): PesertaSeleksi
    {
        return PesertaSeleksi::create($data);
    }

    public function update(PesertaSeleksi $pesertaSeleksi, array $data): PesertaSeleksi
    {
        $pesertaSeleksi->update($data);
        return $pesertaSeleksi->fresh();
    }

    public function delete(PesertaSeleksi $pesertaSeleksi): void
    {
        $pesertaSeleksi->delete();
    }
}

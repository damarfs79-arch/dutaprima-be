<?php

namespace App\Services;

use App\Models\PesertaSeleksi;
use App\Repositories\PesertaSeleksiRepository;

class PesertaSeleksiService
{
    protected PesertaSeleksiRepository $repository;

    public function __construct(PesertaSeleksiRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(?string $status = null)
    {
        return $this->repository->getAll($status);
    }

    public function create(array $data): PesertaSeleksi
    {
        return $this->repository->create($data);
    }

    public function update(PesertaSeleksi $pesertaSeleksi, array $data): PesertaSeleksi
    {
        return $this->repository->update($pesertaSeleksi, $data);
    }

    public function delete(PesertaSeleksi $pesertaSeleksi): void
    {
        $this->repository->delete($pesertaSeleksi);
    }
}

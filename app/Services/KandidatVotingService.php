<?php

namespace App\Services;

use App\Models\KandidatVoting;
use App\Repositories\KandidatVotingRepository;
use Illuminate\Http\UploadedFile;

class KandidatVotingService
{
    protected KandidatVotingRepository $repository;

    public function __construct(KandidatVotingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function create(array $data, ?UploadedFile $foto): KandidatVoting
    {
        if ($foto) {
            $path = $foto->store('kandidat-voting', 'public');
            $data['foto'] = '/storage/' . $path;
        }

        $data['suara'] = $data['suara'] ?? 0;

        return $this->repository->create($data);
    }

    public function update(KandidatVoting $kandidat, array $data, ?UploadedFile $foto): KandidatVoting
    {
        if ($foto) {
            $path = $foto->store('kandidat-voting', 'public');
            $data['foto'] = '/storage/' . $path;
        } else {
            unset($data['foto']);
        }

        return $this->repository->update($kandidat, $data);
    }

    public function delete(KandidatVoting $kandidat): void
    {
        $this->repository->delete($kandidat);
    }

    public function vote(KandidatVoting $kandidat): KandidatVoting
    {
        return $this->repository->incrementVote($kandidat);
    }

    public function resetAllVotes(): void
    {
        $this->repository->resetAllVotes();
    }
}

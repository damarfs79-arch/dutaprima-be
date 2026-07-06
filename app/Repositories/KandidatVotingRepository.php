<?php

namespace App\Repositories;

use App\Models\KandidatVoting;
use Illuminate\Database\Eloquent\Collection;

class KandidatVotingRepository
{
    public function getAll(): Collection
    {
        return KandidatVoting::orderBy('suara', 'desc')->get();
    }

    public function create(array $data): KandidatVoting
    {
        return KandidatVoting::create($data);
    }

    public function update(KandidatVoting $kandidat, array $data): KandidatVoting
    {
        $kandidat->update($data);
        return $kandidat->fresh();
    }

    public function delete(KandidatVoting $kandidat): void
    {
        $kandidat->delete();
    }

    public function incrementVote(KandidatVoting $kandidat): KandidatVoting
    {
        $kandidat->increment('suara');
        return $kandidat->fresh();
    }

    public function resetAllVotes(): void
    {
        KandidatVoting::query()->update(['suara' => 0]);
    }
}

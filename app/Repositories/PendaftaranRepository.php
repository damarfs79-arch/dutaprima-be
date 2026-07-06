<?php

namespace App\Repositories;

use App\Models\Pendaftaran;
use Illuminate\Database\Eloquent\Collection;

class PendaftaranRepository
{
    public function getAll(): Collection
    {
        return Pendaftaran::orderBy('id', 'desc')->get();
    }

    public function create(array $data): Pendaftaran
    {
        return Pendaftaran::create($data);
    }

    public function find(int $id): Pendaftaran
    {
        return Pendaftaran::findOrFail($id);
    }

    public function markAsRead(Pendaftaran $pendaftaran): void
    {
        if (!$pendaftaran->is_read) {
            $pendaftaran->update(['is_read' => true]);
        }
    }

    public function delete(Pendaftaran $pendaftaran): void
    {
        $pendaftaran->delete();
    }

    public function getUnreadCount(): int
    {
        return Pendaftaran::where('is_read', false)->count();
    }
}

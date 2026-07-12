<?php

namespace App\Services;

use App\Models\AdminSetting;

class SettingsService
{
    public function getSetting(string $key, array $default): array
    {
        $setting = AdminSetting::firstOrCreate([
            'key' => $key,
        ], [
            'value' => $default,
        ]);

        return $setting->value;
    }

    public function saveSetting(string $key, array $value): AdminSetting
    {
        return AdminSetting::updateOrCreate([
            'key' => $key,
        ], [
            'value' => $value,
        ]);
    }

    // ==================== Registration ====================

    public function getRegistrationSettings(): array
    {
        return $this->getSetting('registration', $this->defaultRegistrationSettings());
    }

    public function updateRegistrationSettings(array $data): AdminSetting
    {
        $current = $this->getRegistrationSettings();
        $merged  = array_merge($current, $data);

        return $this->saveSetting('registration', $merged);
    }

    // ==================== Selection Flow ====================

    public function getSelectionFlow(): array
    {
        return $this->getSetting('selection_flow', $this->defaultSelectionFlow());
    }

    public function updateSelectionFlow(array $data): AdminSetting
    {
        return $this->saveSetting('selection_flow', $data);
    }

    // ==================== Marquee ====================

    public function getMarqueeSettings(): array
    {
        return $this->getSetting('marquee', $this->defaultMarqueeSettings());
    }

    public function updateMarqueeSettings(array $data): AdminSetting
    {
        $current = $this->getMarqueeSettings();
        $merged  = array_merge($current, $data);

        return $this->saveSetting('marquee', $merged);
    }

    // ==================== Voting ====================

    public function getVotingSettings(): array
    {
        return $this->getSetting('voting', $this->defaultVotingSettings());
    }

    public function updateVotingSettings(array $data): AdminSetting
    {
        $current = $this->getVotingSettings();
        $merged  = array_merge($current, $data);

        return $this->saveSetting('voting', $merged);
    }



    // ==================== Angkatan ====================

    public function getAngkatanSettings(): array
    {
        return $this->getSetting('angkatan_list', [25, 24, 23]);
    }

    public function updateAngkatanSettings(array $angkatanList): AdminSetting
    {
        return $this->saveSetting('angkatan_list', array_map('intval', $angkatanList));
    }

    // ==================== Defaults ====================

    protected function defaultRegistrationSettings(): array
    {
        return [
            'title' => 'Formulir Pendaftaran Online',
            'marquee_show' => true,
            'marquee_text' => 'Pendaftaran Duta Prima Tersisa 15 Kuota! Buruan Daftar!',
            'fields' => [
                ['id' => 1, 'type' => 'text', 'label' => 'Nama Lengkap', 'placeholder' => 'Masukkan nama sesuai raport', 'required' => true],
                ['id' => 2, 'type' => 'text', 'label' => 'Kelas Dan Jurusan', 'placeholder' => 'Masukkan kelas dan jurusan Anda', 'required' => true],
                ['id' => 3, 'type' => 'text', 'label' => 'TTL (Tempat, Tanggal Lahir)', 'placeholder' => 'Contoh: Jember, 1 Januari 2007', 'required' => true],
                ['id' => 4, 'type' => 'text', 'label' => 'Nomor WhatsApp', 'placeholder' => 'Contoh: 081234567890', 'required' => true],
                ['id' => 5, 'type' => 'text', 'label' => 'Username Instagram (Opsional)', 'placeholder' => 'username_ig', 'required' => false],
                ['id' => 6, 'type' => 'text', 'label' => 'Username TikTok (Opsional)', 'placeholder' => 'username_tiktok', 'required' => false],
                ['id' => 7, 'type' => 'text', 'label' => 'Bakat', 'placeholder' => 'Contoh: Menyanyi, Public Speaking, Menari, dll', 'required' => true],
                ['id' => 8, 'type' => 'textarea', 'label' => 'Motivasi Bergabung', 'placeholder' => 'Apa tujuan dan alasan Anda mengikuti seleksi Duta?', 'required' => false],
                ['id' => 9, 'type' => 'textarea', 'label' => 'Prestasi yang Pernah Diperoleh', 'placeholder' => 'Sebutkan prestasi yang pernah diraih (akademik/non-akademik)', 'required' => false],
                ['id' => 10, 'type' => 'file', 'label' => 'Unggah Foto Profil', 'placeholder' => '(3x4/4x6)', 'required' => true],
            ],
        ];
    }

    protected function defaultSelectionFlow(): array
    {
        return [
            'steps' => [
                ['id' => 1, 'title' => 'Pendaftaran Online', 'date' => '15 Januari - 30 Januari 2024', 'desc' => 'Isi formulir lengkap dan unggah foto terbaikmu untuk seleksi administrasi awal.', 'icon' => '📝'],
                ['id' => 2, 'title' => 'Seleksi Administrasi', 'date' => '01 Februari - 05 Februari 2024', 'desc' => 'Tim seleksi akan memverifikasi kelengkapan berkas dan kriteria dasar pendaftar.', 'icon' => '✅'],
                ['id' => 3, 'title' => 'Wawancara & Bakat', 'date' => '10 Februari 2024', 'desc' => 'Tunjukkan kepribadian, visi, dan bakat unikmu di depan dewan juri.', 'icon' => '👥'],
                ['id' => 4, 'title' => 'Grand Final', 'date' => '25 Desember 2026', 'desc' => 'Malam penganugerahan dan penentuan Duta Prima PGRI 05 terpilih.', 'icon' => '🏆'],
            ],
        ];
    }

    protected function defaultMarqueeSettings(): array
    {
        return [
            'pendaftaran_show' => true,
            'pendaftaran_text' => 'Segera daftarkan diri anda. Sisa kuota 30!',
            'pengumuman_show'  => true,
            'pengumuman_text'  => 'Menunggu Hasil Seleksi? Tetap Semangat Dan Berikan Yang Terbaik!',
            'voting_text1'     => 'Pantau Terus Pengumuman Ini Untuk Update Terbaru Duta Prima 2026',
            'voting_text2'     => 'Pemilihan Duta Favorit Akan Ditutup Pada 30 November 2026',
        ];
    }

    protected function defaultVotingSettings(): array
    {
        return [
            'end_time' => null, // ISO string or null
        ];
    }
}

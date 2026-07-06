<?php
use Illuminate\Support\Facades\DB;

$prefixes = ['http://127.0.0.1:8000', 'http://localhost:8000', 'http://localhost'];

foreach ($prefixes as $prefix) {
    DB::update("UPDATE galleries SET image = REPLACE(image, ?, '')", [$prefix]);
    DB::update("UPDATE dutas SET photo = REPLACE(photo, ?, ''), photo_couple = REPLACE(photo_couple, ?, ''), photo_female = REPLACE(photo_female, ?, '')", [$prefix, $prefix, $prefix]);
    DB::update("UPDATE pendaftarans SET foto_full = REPLACE(foto_full, ?, ''), foto_half = REPLACE(foto_half, ?, ''), file_prestasi = REPLACE(file_prestasi, ?, '')", [$prefix, $prefix, $prefix]);
}

echo "Images fixed completely!\n";

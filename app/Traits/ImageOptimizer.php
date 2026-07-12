<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

trait ImageOptimizer
{
    /**
     * Mengoptimasi gambar: simpan original, generate WebP, dan Thumbnail WebP.
     * Mengembalikan array yang berisi path untuk database.
     */
    public function optimizeImage(UploadedFile $file, string $directory, int $thumbWidth = 400): array
    {
        // Pastikan direktori ada
        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }

        $manager = new ImageManager(new Driver());
        $filename = uniqid() . '_' . time();
        $originalExt = $file->getClientOriginalExtension();
        
        // 1. Simpan Original (jangan kompres)
        $originalPath = $file->storeAs($directory, $filename . '.' . $originalExt, 'public');
        
        // 2. Generate WebP Kualitas Tinggi
        $img = $manager->decodePath($file->path());
        $webpContent = $img->encodeUsingFileExtension('webp', quality: 85)->toString();
        $webpPath = $directory . '/' . $filename . '.webp';
        Storage::disk('public')->put($webpPath, $webpContent);
        
        // 3. Generate Thumbnail WebP
        $imgThumb = $manager->decodePath($file->path());
        $imgThumb->scaleDown(width: $thumbWidth);
        $thumbContent = $imgThumb->encodeUsingFileExtension('webp', quality: 80)->toString();
        $thumbPath = $directory . '/' . $filename . '_thumb.webp';
        Storage::disk('public')->put($thumbPath, $thumbContent);
        
        return [
            'original' => '/storage/' . $originalPath,
            'webp'     => '/storage/' . $webpPath,
            'thumb'    => '/storage/' . $thumbPath,
        ];
    }
}

<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class LandingImagesHandler {
    public static function upload (UploadedFile $image, string $base_path, string $format, bool $crop):string
    {
        Storage::disk('public')->deleteDirectory($base_path);
        $path = '/storage/' . $image->storePubliclyAs($base_path, $image->getClientOriginalName(), ['disk' => 'public']);
        ImageHandler::resize($image, $path, $format, $crop);
        return $path;
    }

    public static function addToGallery (UploadedFile $image, string $base_path):string
    {
        return '/storage/' . $image->storePubliclyAs($base_path, $image->getClientOriginalName(), ['disk' => 'public']);
    }

    public static function removeFromGallery (array $current, array $list):array
    {
        foreach ($list as $path) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $path));
        }

        return array_diff($current, $list);
    }
}

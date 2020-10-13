<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageHandler
{
    /**
     * Handles of of MyPetsNanny's uploads, returns the path when done uploading.
     *
     * @param UploadedFile $file
     *   The uploaded file
     * @param $origin
     *   The content type (category, user, activity...)
     * @param $id
     *   The content's id.
     * @param bool $update
     *   If true, will remove the old image.
     *
     * @return string
     *   Returns the uploaded image's path.
     */
    public static function upload (UploadedFile $file, $origin, $id, $update = FALSE) : string
    {
        $base_path = "/$origin/$id";

        if ($update) {
            Storage::disk('public')->deleteDirectory($base_path);
        }

        $path = $file->storePubliclyAs($base_path, $file->getClientOriginalName(), ['disk' => 'public']);

        return '/storage/' . $path;
    }

    public static function resize (string $path, string $size)
    {
        // TODO: use Intervention/Image
        return '';
    }

    /**
     * Is called when deleting a content type that contains medias.
     *
     * @param string $origin
     *   The content type (category, user, activity...)
     * @param int $id
     *   The content's id.
     *
     * @return void
     */
    public static function cleanup ($origin, $id) : void
    {
        $base_path = "/$origin/$id";
        Storage::disk('public')->deleteDirectory($base_path);
    }
}

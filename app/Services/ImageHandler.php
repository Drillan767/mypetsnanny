<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

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

    /**
     * @param UploadedFile $file
     *   The image object.
     * @param string $path
     *   The image's original path.
     * @param string $size
     *   The desired image width.
     * @param boolean $crop
     *   Will either crop or resize the image.
     *
     * @return string
     *   Returns the image's path.
     */
    public static function resize (UploadedFile $file, string $path, string $size, $crop)
    {
        list($width, $height) = explode('_', $size);

        $img = Image::make($file);
        if ($crop) {
            $img->crop($width, $height);
        } else {
            $img->resize($width, $height);
        }

        $img->save(public_path($path));
        return $path;
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

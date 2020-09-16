<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class ImageHandler
{
    /**
     * @param UploadedFile $file
     *   The uploaded file
     * @param $origin
     *   States the model's origin (category, user, prestation...)
     * @param $id
     *   The content's id.
     * @param bool $update
     *   If true, will remove the old image.
     *
     * @return string
     *   Returns the uploaded image's path.
     */
    public static function upload (UploadedFile $file, $origin, $id, $update = FALSE)
    {
        $path = $file->storePubliclyAs("/$origin/$id", $file->getClientOriginalName(), ['disk' => 'public']);
        return '/storage/' . $path;
    }
}

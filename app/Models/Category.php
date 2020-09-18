<?php

namespace App\Models;

use App\Services\ImageHandler;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * Forces the boolean.
     *
     * @var string[]
     */
    protected $casts = [
        'whole_day' => 'boolean'
    ];

    /**
     * @return HasMany
     */
    public function activities ()
    {
        return $this->hasMany('App\Models\Activity');
    }

    /**
     * Calls an action that will cleanup the category's images
     * and delete all related activities.
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete()
    {
//        $this->activities()->delete();
        return parent::delete();
    }
}

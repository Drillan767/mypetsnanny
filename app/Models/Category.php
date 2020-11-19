<?php

namespace App\Models;

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

    public function getSlugAttribute ()
    {
        $title = strtolower($this->title);
        // Replaces spaces by underscore.
        $title = str_replace(' ', '_', $title);
        // Removes any letter that isn't a letter or number.
        $title = preg_replace('/[^a-zA-Z0-9_.]/', '', $title);
        // Cleans up any double underscore.
        $title = str_replace('__', '_', $title);
        return $title;
    }

    protected $appends = ['slug'];
}

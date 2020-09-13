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
    public function prestations ()
    {
        return $this->hasMany('App\Models\Prestation');
    }
}

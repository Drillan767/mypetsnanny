<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Activity extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function  category ()
    {
        return $this->belongsTo('App\Model\Category');
    }

    /**
     * @return BelongsToMany
     */
    public function users ()
    {
        return $this->belongsToMany('App\Model\User');
    }
}

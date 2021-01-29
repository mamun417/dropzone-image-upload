<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Data
 * @mixin Eloquent
 */
class Data extends Model
{
    use HasFactory;

    protected $table = 'data';

    protected $fillable = [
        'name',
        'email',
        'phone'
    ];

    public function images(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}

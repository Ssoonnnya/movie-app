<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_uk',
        'title_en',
        'description_uk',
        'description_en',
        'poster',
        'screenshots',
        'youtube_trailer_id',
        'release_year',
        'status',
    ];

}

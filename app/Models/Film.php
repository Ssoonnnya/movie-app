<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Cast;
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

    public function cast()
    {
        return $this->hasMany(Cast::class);
    }
}

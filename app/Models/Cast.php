<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'name_uk',
        'name_en',
        'photo',
        'film_id',
    ];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}

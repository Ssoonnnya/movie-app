<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    protected $fillable = [
        'name_uk',
        'name_en',
        'slug',
        'film_id'
    ];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($tag) {
            if ($tag->name_en) {
                $tag->slug = Str::slug($tag->name_en);
            } elseif ($tag->name_uk) {
                $tag->slug = Str::slug($tag->name_uk);
            }
        });
    }
    public function films()
    {
        return $this->belongsToMany(Film::class, 'film_tag');
    }
}

<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;

    protected $table ='videos';

    protected $fillable = ['title', 'description','youtube_url','slug'];

    public function parts()
    {
        return $this->hasMany(VideoPart::class);
    }

     protected static function boot()
    {
        parent::boot();

        static::creating(function ($video) {
            $video->slug = Str::slug($video->title). '-' . uniqid();
        });
    }

    public function progress(){
        return $this->hasMany(VideoProgress::class);
    }
}

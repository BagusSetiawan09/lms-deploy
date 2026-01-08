<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VideoPart extends Model
{
    use HasFactory;

    protected $table = 'video_parts';

    protected $fillable = ['video_id', 'title', 'youtube_url'];

    public function video()
    {
        return $this->belongsTo(Video::class,'video_id','id');
    }
}

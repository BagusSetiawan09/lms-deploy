<?php

namespace App\Models;

use App\Models\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Monitoring extends Model
{
    use HasFactory;

    protected $table = 'video_progress';
    protected $fillable = [
        'user_id',
        'video_id',
        'progress',
        'duration',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function videoProgress()
    {
        return $this->hasOne(VideoProgress::class, 'video_id', 'video_id');
    }

}

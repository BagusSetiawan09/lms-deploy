<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TugasSubmission extends Model
{
    protected $fillable = ['tugas_id', 'user_id', 'file_path', 'jawaban', 'status', 'nilai', 'feedback'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function tugas()
    {
        return $this->belongsTo(Tugas::class,'tugas_id');
    }
}

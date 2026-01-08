<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $fillable = ['judul', 'deskripsi', 'deadline','file'];

    public function submissions()
    {
        return $this->hasMany(TugasSubmission::class,'tugas_id');
    }
}

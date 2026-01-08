<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verifikasi extends Model
{
    protected $table='verifikasis';
    protected $fillable=[
        'name',
        'email',
        'nama_pembimbing',
        'role',
        'password_plain'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswas'; // sesuaikan dengan nama tabel migration
    protected $fillable = ['nim', 'nama', 'prodi_id']; // HARUS SESUAI KOLOM DATABASE

    public function prodi()
    
    {
        return $this->belongsTo(Prodi::class);
    }
}

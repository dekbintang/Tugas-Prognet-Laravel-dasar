<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswas';
    protected $fillable = ['nim', 'nama', 'prodi_id'];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function fakultas()
    {
        return $this->hasOneThrough(
            Fakultas::class,  // model tujuan akhir
            Prodi::class,     // model perantara
            'id',             // foreign key di tabel prodis (relasi ke mahasiswa)
            'id',             // foreign key di tabel fakultas (relasi ke prodis)
            'prodi_id',       // foreign key di tabel mahasiswas
            'fakultas_id'     // foreign key di tabel prodis
        );
    }
}

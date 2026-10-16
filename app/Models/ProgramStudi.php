<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    protected $fillable = ['kode_prodi', 'nama_prodi'];

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'program_studi_id');
    }
}

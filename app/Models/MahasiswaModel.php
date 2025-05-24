<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'mahasiswa_id';
    public $timestamps = true;

    protected $fillable = [
        'nim',
        'nama',
        'angkatan',
        'no_telp',
        'jenis_kelamin',
        'status',
        'keterangan',
        'prodi_id',
    ];

public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function prodi()
{
    return $this->belongsTo(ProdiModel::class, 'prodi_id');
}

}

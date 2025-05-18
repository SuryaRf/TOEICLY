<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalModel extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $primaryKey = 'jadwal_id';
    public $timestamps = true;

    protected $fillable = [
        'tanggal_pelaksanaan',
        'jam_mulai',
        'jam_selesai',
        'keterangan',
    ];

    protected $dates = [
        'tanggal_pelaksanaan',
        'jam_mulai',
        'jam_selesai',
        'created_at',
        'updated_at',
    ];
     protected $casts = [
        'tanggal_pelaksanaan' => 'datetime',
    ];

    // Relasi ke Pendaftaran
    public function pendaftarans()
    {
        return $this->hasMany(PendaftaranModel::class, 'jadwal_id', 'jadwal_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranModel extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';
    protected $primaryKey = 'pendaftaran_id';
    public $timestamps = true;

    protected $fillable = [
        'pendaftaran_kode',
        'tanggal_pendaftaran',
        'scan_ktp',
        'scan_ktm',
        'pas_foto',
        'mahasiswa_id',
        'jadwal_id',
    ];

    protected $dates = [
        'tanggal_pendaftaran',
        'created_at',
        'updated_at',
    ];
    // Tambahkan ini untuk otomatis cast ke Carbon
    protected $casts = [
        'tanggal_pendaftaran' => 'datetime',
    ];

    // Relasi ke Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(MahasiswaModel::class, 'mahasiswa_id', 'mahasiswa_id');
    }

    // Relasi ke Jadwal
    public function jadwal()
    {
        return $this->belongsTo(JadwalModel::class, 'jadwal_id', 'jadwal_id');
    }

    // Relasi ke DetailPendaftaran
    public function detail()
    {
        return $this->hasOne(DetailPendaftaranModel::class, 'pendaftaran_id', 'pendaftaran_id');
    }

    // Di PendaftaranModel.php
    public function sertifikatStatus()
    {
        return $this->hasOne(SertifikatStatus::class, 'pendaftaran_id', 'pendaftaran_id');
    }
}

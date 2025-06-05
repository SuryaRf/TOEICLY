<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MahasiswaModel;
use App\Models\JadwalModel;
use App\Models\DetailPendaftaranModel;
use App\Models\SertifikatStatus;

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

    // Gunakan $casts untuk tipe datetime
    protected $casts = [
        'tanggal_pendaftaran' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(MahasiswaModel::class, 'mahasiswa_id', 'mahasiswa_id');
    }
        public function detail()
    {
        return $this->hasOne(DetailPendaftaranModel::class, 'pendaftaran_id', 'pendaftaran_id');
    }

    // Relasi ke Jadwal
    public function jadwal()
    {
        return $this->belongsTo(JadwalModel::class, 'jadwal_id', 'jadwal_id');
    }

    // Relasi ke DetailPendaftaran (pilih salah satu nama)
    public function detailPendaftaran()
    {
        return $this->hasOne(DetailPendaftaranModel::class, 'pendaftaran_id', 'pendaftaran_id');
    }

    // Relasi ke SertifikatStatus (pastikan nama model benar)
    public function sertifikatStatus()
    {
        return $this->hasOne(SertifikatStatus::class, 'pendaftaran_id', 'pendaftaran_id');
    }
    
    // Hapus method detail() jika tidak diperlukan
    // public function detail()
    // {
    //     return $this->hasOne(DetailPendaftaranModel::class, 'pendaftaran_id', 'pendaftaran_id');
    // }
}
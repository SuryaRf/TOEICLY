<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPendaftaranModel extends Model
{
    use HasFactory;

    protected $table = 'detail_pendaftaran';
    protected $primaryKey = 'detail_id';
    public $timestamps = true;

    protected $fillable = [
        'pendaftaran_id',
        'status',   // menunggu, diterima, ditolak
        'catatan',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // Relasi ke Pendaftaran
    public function pendaftaran()
    {
        return $this->belongsTo(PendaftaranModel::class, 'pendaftaran_id', 'pendaftaran_id');
    }
}

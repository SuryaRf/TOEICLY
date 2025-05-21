<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SertifikatStatus extends Model
{
    use HasFactory;

    protected $table = 'sertifikat_status';

    protected $fillable = ['pendaftaran_id', 'status'];

    public function pendaftaran()
    {
        return $this->belongsTo(PendaftaranModel::class, 'pendaftaran_id', 'pendaftaran_id');
    }
}


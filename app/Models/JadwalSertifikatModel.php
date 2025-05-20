<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalSertifikatModel extends Model
{
    use HasFactory;

    protected $table = 'jadwal_sertifikat';
    protected $primaryKey = 'jadwal_id';
    protected $fillable = ['judul', 'file_pdf'];
    public $timestamps = true;
}

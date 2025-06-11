<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model untuk tabel nilai_toeic
 *
 * @property int $nilai_toeic_id
 * @property string $file_path
 * @property int $itc_id
 * @property string $judul
 */
class NilaiToeicModel extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'nilai_toeic';

    // Primary key
    protected $primaryKey = 'nilai_toeic_id';

    // Kolom yang bisa diisi
    protected $fillable = [
        'file_path',
        'itc_id',
        'judul',
    ];

    // Relasi ke ITC
    public function itc()
    {
        return $this->belongsTo(ItcModel::class, 'itc_id', 'itc_id');
    }
}
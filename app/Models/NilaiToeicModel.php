<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiToeicModel extends Model
{
    use HasFactory;

    protected $table = 'nilai_toeic';
    protected $primaryKey = 'nilai_toeic_id';

    protected $fillable = [
        'file_path',
        'itc_id',
        'judul',
    ];

    public function itc()
    {
        return $this->belongsTo(ItcModel::class, 'itc_id', 'itc_id');
    }
}
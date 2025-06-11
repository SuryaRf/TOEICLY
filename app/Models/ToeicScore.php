<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToeicScore extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'toeic_scores';

    // Primary key
    protected $primaryKey = 'id';

    protected $fillable = [
    'user_id',
    'file_path',
    'itc_id',
    'judul',
    'score',
    'certificate_date',
    'certificate_pdf'
];

    public function user()
    {
        return $this->belongsTo(UserModel::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToeicScore extends Model
{
    protected $fillable = ['user_id', 'score', 'certificate_date', 'certificate_pdf'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

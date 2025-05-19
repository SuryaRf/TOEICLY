<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItcModel extends Model
{
    use HasFactory;

    protected $table = 'itc';
    protected $primaryKey = 'itc_id';
    public $timestamps = true;

    protected $fillable = [
        'nama',
        'no_telp',
    ];

    // Relasi ke User (one to one)
    public function user()
    {
        return $this->hasOne(UserModel::class, 'itc_id', 'itc_id');
    }
    public function itc()
    {
        return $this->belongsTo(ItcModel::class, 'itc_id', 'itc_id');
    }
}

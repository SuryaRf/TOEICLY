<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    use HasFactory;

    protected $table = 'admin';
    protected $primaryKey = 'admin_id';
    public $timestamps = true;

    protected $fillable = [
        'nama',
        'no_telp'
    ];


    // Di App\Models\AdminModel.php
    public function user()
    {
        return $this->hasOne(UserModel::class, 'admin_id', 'admin_id');
    }
}

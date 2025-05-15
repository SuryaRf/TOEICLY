<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class UserModel extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $timestamps = true;

    protected $fillable = [
        'email',
        'username',
        'password',
        'profile',
        'role',
        'admin_id',
        'mahasiswa_id',
        'dosen_id',
        'tendik_id'
    ];

    // Relasi 
    public function admin()
    {
        return $this->belongsTo(AdminModel::class, 'admin_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(MahasiswaModel::class, 'mahasiswa_id');
    }

    public function dosen()
    {
        return $this->belongsTo(DosenModel::class, 'dosen_id');
    }

    public function tendik()
    {
        return $this->belongsTo(TendikModel::class, 'tendik_id');
    }
    public function getAuthPassword()
    {
        return $this->password;
    }
    // 🔥 Ini untuk fix login pakai kolom username
    public function getAuthIdentifierName()
    {
        return 'username';
    }
}

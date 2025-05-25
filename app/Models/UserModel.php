<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class UserModel extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user'; // Corrected to 'users' to match your schema
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
        'tendik_id',
        'itc_id',
    ];

    // Relasi (corrected to hasOne since the foreign key is in users table)
    public function admin()
    {
        return $this->hasOne(AdminModel::class, 'admin_id', 'admin_id');
    }

    public function mahasiswa()
    {
        return $this->hasOne(MahasiswaModel::class, 'mahasiswa_id', 'mahasiswa_id');
    }

    public function dosen()
    {
        return $this->hasOne(DosenModel::class, 'dosen_id', 'dosen_id');
    }

    public function tendik()
    {
        return $this->hasOne(TendikModel::class, 'tendik_id', 'tendik_id');
    }

    public function itc()
    {
        return $this->hasOne(ItcModel::class, 'itc_id', 'itc_id');
    }

    public function getAuthIdentifierName()
    {
        return 'email'; // Revert to default or use a custom guard if needed
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
}
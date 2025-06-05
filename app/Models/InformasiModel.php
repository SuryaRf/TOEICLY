<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiModel extends Model
{
    use HasFactory;

    protected $table = 'informasi';
    protected $primaryKey = 'informasi_id';

    protected $fillable = [
        'judul',
        'isi',
        'admin_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Define the relationship with AdminModel
     */
    public function admin()
    {
        return $this->belongsTo(AdminModel::class, 'admin_id', 'admin_id');
    }
}
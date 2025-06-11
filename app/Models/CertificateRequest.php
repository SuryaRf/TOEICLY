<?php

  namespace App\Models;

  use Illuminate\Database\Eloquent\Model;

  class CertificateRequest extends Model
  {
      protected $table = 'certificate_requests';
      protected $fillable = ['pendaftaran_id', 'status', 'notes', 'file_path'];

      public function pendaftaran()
      {
          return $this->belongsTo(PendaftaranModel::class, 'pendaftaran_id');
      }
  }
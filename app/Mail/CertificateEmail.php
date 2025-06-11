<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class CertificateEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $mahasiswaName;
    public $subject;
    public $message;
    public $filePath;
    public $fileName;

    public function __construct($mahasiswaName, $subject, $message, $filePath = null, $fileName = null)
    {
        $this->mahasiswaName = $mahasiswaName;
        $this->subject = $subject;
        $this->message = $message;
        $this->filePath = $filePath;
        $this->fileName = $fileName;
    }

    public function build()
    {
        $email = $this->subject($this->subject)
                      ->view('emails.user_message') // Gunakan view yang ada
                      ->with([
                          'username' => $this->mahasiswaName, // Sesuaikan dengan nama mahasiswa
                          'messageContent' => $this->message,
                      ]);

        if ($this->filePath && $this->fileName && Storage::disk('public')->exists($this->filePath)) {
            $email->attach(Storage::disk('public')->path($this->filePath), ['as' => $this->fileName]);
        }

        return $email;
    }
}
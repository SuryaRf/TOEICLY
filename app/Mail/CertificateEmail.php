<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

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
                      ->view('emails.certificate');

        if ($this->filePath && $this->fileName) {
            $email->attach($this->filePath, ['as' => $this->fileName]);
        }

        return $email;
    }
}
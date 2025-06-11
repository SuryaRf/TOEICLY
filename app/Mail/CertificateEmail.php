<?php

  namespace App\Mail;

  use Illuminate\Bus\Queueable;
  use Illuminate\Mail\Mailable;
  use Illuminate\Queue\SerializesModels;
  use Illuminate\Support\Facades\Storage;

  class CertificateEmail extends Mailable
  {
      use Queueable, SerializesModels;

      public $username;
      public $subject;
      public $messageContent;
      public $attachmentPath;

      public function __construct($username, $subject, $messageContent, $attachmentPath = null)
      {
          $this->username = $username;
          $this->subject = $subject;
          $this->messageContent = $messageContent;
          $this->attachmentPath = $attachmentPath;
      }

      public function build()
      {
          $email = $this->subject($this->subject)
              ->view('emails.user_message');

          if ($this->attachmentPath) {
              $email->attach(Storage::disk('public')->path($this->attachmentPath), [
                  'as' => 'certificate.pdf',
                  'mime' => 'application/pdf',
              ]);
          }

          return $email;
      }
  }
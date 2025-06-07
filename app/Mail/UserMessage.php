<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\UserModel;

class UserMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $messageContent;
    public $filePath;
    public $fileName;

    /**
     * Create a new message instance.
     */
    public function __construct(UserModel $user, $messageContent, $filePath = null, $fileName = null)
    {
        $this->user = $user;
        $this->messageContent = $messageContent;
        $this->filePath = $filePath;
        $this->fileName = $fileName;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $email = $this->subject('Message from TOEICLY Admin')
            ->view('emails.user_message')
            ->with([
                'username' => $this->user->username,
                'messageContent' => $this->messageContent,
            ]);

        if ($this->filePath && $this->fileName) {
            $email->attach($this->filePath, [
                'as' => $this->fileName,
                'mime' => mime_content_type($this->filePath),
            ]);
        }

        return $email;
    }
}
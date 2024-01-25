<?php

namespace App\Mail;

class ResponseMail
{
    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function send($to, $subject, $message)
    {
        $content = "From: ".env("MAIL_FROM_ADDRESS")."\nTo: $to\nSubject: $subject\n\n$message";
        
        $directory = storage_path('app/emails');
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        file_put_contents($this->filePath . '/' . time() . '.txt', $content);
    }
}


<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PartnershipInquiry extends Mailable
{
    use Queueable, SerializesModels;

    public string $fname;
    public string $lname;
    public string $email;
    public string $phone;
    public string $body;

    public function __construct(string $fname, string $lname, string $email, string $phone, string $body)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->phone = $phone;
        $this->body  = $body;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Partnership Inquiry from ' . $this->fname . ' ' . $this->lname,
            replyTo: [
                new \Illuminate\Mail\Mailables\Address($this->email, $this->fname),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.partnership',
        );
    }
}
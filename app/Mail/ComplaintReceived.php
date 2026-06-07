<?php

namespace App\Mail;

use App\Models\PolicyComplaint;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ComplaintReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public PolicyComplaint $complaint) {}

    public function envelope(): Envelope
{
    return new Envelope(
        subject: 'New Complaint: ' . $this->complaint->type_of_concern,
        replyTo: [
            new \Illuminate\Mail\Mailables\Address($this->complaint->contact_info),
        ],
    );
}

    public function content(): Content
    {
        return new Content(
            view: 'emails.complaint',
        );
    }
}
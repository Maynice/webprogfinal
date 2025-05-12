<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RequestDocument extends Mailable
{
    use Queueable, SerializesModels;

    public int $submissionId;
    public string $applicantName;
    public string $requestInfo;
    public string $reviewerName;

    /**
     * Create a new message instance.
     */
    public function __construct(
        int $submissionId,
        string $applicantName,
        string $requestInfo,
        string $reviewerName,
    )
    {
        $this->submissionId = $submissionId;
        $this->applicantName = $applicantName;
        $this->requestInfo = $requestInfo;
        $this->reviewerName = $reviewerName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Request for Additional Document (Submission ID: ' . $this->submissionId . ')',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.requestdocument', // blade file
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

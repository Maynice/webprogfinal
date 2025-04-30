<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicantStatus extends Mailable
{
    use Queueable, SerializesModels;

    // data
    public int $submissionId;
    public string $applicantName;
    public string $applicantEmail;
    public string $updatedByName;
    public string $updatedByEmail;
    public string $submissionStatus;

    /**
     * Create a new message instance.
     */
    public function __construct(
        int $submissionId,
        string $applicantName,
        string $applicantEmail,
        string $updatedByName,
        string $updatedByEmail,
        string $submissionStatus
    ) {
        $this->submissionId = $submissionId;
        $this->applicantName = $applicantName;
        $this->applicantEmail = $applicantEmail;
        $this->updatedByName = $updatedByName;
        $this->updatedByEmail = $updatedByEmail;
        $this->submissionStatus = $submissionStatus;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Update on Your Application Status (ID: ' . $this->submissionId . ')',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // send data to view
        return new Content(
            view: 'emails.status', // Path to the Blade view
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
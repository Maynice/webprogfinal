<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UploadDocument extends Mailable
{
    use Queueable, SerializesModels;

    // store variables
    public int $submissionId;
    public int $requestId;
    public string $applicantName;
    public string $applicantEmail;
    public string $requestInfo;
    public string $uploadedFileName;

    /**
     * Create a new message instance.
     */
    public function __construct(
        int $submissionId,
        int $requestId,
        string $applicantName,
        string $applicantEmail,
        string $requestInfo,
        string $uploadedFileName
    ) {
        $this->submissionId = $submissionId;
        $this->requestId = $requestId;
        $this->applicantName = $applicantName;
        $this->applicantEmail = $applicantEmail;
        $this->requestInfo = $requestInfo;
        $this->uploadedFileName = $uploadedFileName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Document Uploaded by Applicant for Request #{$this->requestId}, (Submission #{$this->submissionId})",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.uploaddocument',
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

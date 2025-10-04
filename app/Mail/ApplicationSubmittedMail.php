<?php
// app/Mail/ApplicationSubmittedMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Mailable for sending application submission notifications with JSON attachment
 */
class ApplicationSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $applicationData;
    public $jsonFilePath;
    public $userName;
    public $applicationType;

    /**
     * Create a new message instance.
     *
     * @param array $applicationData
     * @param string $jsonFilePath
     * @param string $userName
     * @param string $applicationType
     */
    public function __construct(
        array $applicationData, 
        string $jsonFilePath, 
        string $userName,
        string $applicationType
    ) {
        $this->applicationData = $applicationData;
        $this->jsonFilePath = $jsonFilePath;
        $this->userName = $userName;
        $this->applicationType = $applicationType;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $transactionId = $this->applicationData['application_info']['transaction_id'] ?? 'N/A';
        $filename = sprintf(
            'application_%s_%s.json',
            $transactionId,
            date('Y-m-d_His')
        );

        return $this->subject('New Application Submission - ' . $this->userName)
                    ->view('emails.application-submitted')
                    ->attach($this->jsonFilePath, [
                        'as' => $filename,
                        'mime' => 'application/json',
                    ])
                    ->with([
                        'userName' => $this->userName,
                        'applicationType' => $this->applicationType,
                        'transactionId' => $transactionId,
                        'submittedAt' => $this->applicationData['application_info']['submitted_at'] ?? now(),
                    ]);
    }
}
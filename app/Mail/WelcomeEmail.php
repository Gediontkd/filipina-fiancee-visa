<?php
// app/Mail/WelcomeEmail.php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Welcome email sent to newly registered users
 */
class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome to ' . config('app.name') . ' - Get Started with Your Visa Application')
                    ->view('emails.welcome')
                    ->with([
                        'userName' => $this->user->name,
                        'userEmail' => $this->user->email,
                        'loginUrl' => route('login'),
                        'dashboardUrl' => route('user.page', 'progress'),
                    ]);
    }
}
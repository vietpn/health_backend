<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    public $actionUrl = '';
    public $actionText = 'Reset Password';
    public $introLines = [
        'You are receiving this email because we received a password reset request for your account.'
    ];
    public $outroLines = [
        'If you did not request a password reset, no further action is required.'
    ];
    public $level = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($linkReset)
    {
        $this->actionUrl = $linkReset;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('vendor.notifications.email')
            ->subject('Eyeland password reset link');
    }
}

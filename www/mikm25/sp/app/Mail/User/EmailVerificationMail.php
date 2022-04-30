<?php

namespace App\Mail\User;

use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerificationMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * @var User
     */
    private $user;

    /**
     * @var EmailVerification
     */
    private $verification;

    public function __construct(User $user, EmailVerification $verification)
    {
        $this->user = $user;
        $this->verification = $verification;

        $this->subject = __('mails.user.email_verification.subject', [
            'appName' => config('app.name'),
        ]);
    }

    public function build(): self
    {
        return $this->markdown('mails.user.email-verification', [
            'user' => $this->user,
            'verificationLink' => $this->verification->verification_link,
        ]);
    }
}

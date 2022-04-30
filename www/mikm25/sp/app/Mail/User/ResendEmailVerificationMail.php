<?php

namespace App\Mail\User;

use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResendEmailVerificationMail extends Mailable
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

        $this->subject = __('mails.user.resend_email_verification.subject', [
            'appName' => config('app.name'),
        ]);
    }

    public function build(): self
    {
        return $this->markdown('mails.user.resend-email-verification', [
            'user' => $this->user,
            'verificationLink' => $this->getVerificationLink(),
        ]);
    }

    private function getVerificationLink(): string
    {
        return route('auth.email-verification.verify', [
            'token' => $this->verification->token,
        ]);
    }
}

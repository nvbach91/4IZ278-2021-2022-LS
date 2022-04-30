<?php

namespace App\Mail\User;

use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class RegisteredMail extends Mailable
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

        $this->subject = __('mails.user.registered.subject', [
            'appName' => config('app.name'),
        ]);
    }

    public function build(): self
    {
        return $this->markdown('mails.user.registered', [
            'user' => $this->user,
            'verificationLink' => $this->getVerificationLink(),
        ]);
    }

    private function getVerificationLink(): string
    {
        return URL::temporarySignedRoute(
            'auth.email-verification.verify',
            $this->verification->valid_until,
            ['token' => $this->verification->token]
        );
    }
}

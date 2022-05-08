<?php

namespace App\Mail\User;

use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

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

        /** @var string $subject */
        $subject = __('mails.user.registered.subject', [
            'appName' => config('app.name'),
        ]);

        $this->subject = $subject;
    }

    public function build(): self
    {
        return $this->markdown('mails.user.registered', [
            'user' => $this->user,
            'verificationLink' => $this->verification->verification_link,
        ]);
    }
}

<?php

namespace App\Mail\User;

use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgottenPasswordMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * @var User
     */
    private $user;

    /**
     * @var PasswordReset
     */
    private $passwordReset;

    public function __construct(User $user, PasswordReset $passwordReset)
    {
        $this->user = $user;
        $this->passwordReset = $passwordReset;

        $this->subject = __('mails.user.forgotten_password.subject', [
            'appName' => config('app.name'),
        ]);
    }

    public function build(): self
    {
        return $this->markdown('mails.user.forgotten-password', [
            'user' => $this->user,
            'resetLink' => $this->getPasswordResetLink(),
        ]);
    }

    private function getPasswordResetLink(): string
    {
        return route('auth.password-reset.form', [
            'token' => $this->passwordReset->token,
        ]);
    }
}

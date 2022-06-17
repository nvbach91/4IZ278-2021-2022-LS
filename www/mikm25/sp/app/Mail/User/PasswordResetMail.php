<?php

namespace App\Mail\User;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;

        /** @var string $subject */
        $subject = __('mails.user.password_reset.subject', [
            'appName' => config('app.name'),
        ]);

        $this->subject = $subject;
    }

    public function build(): self
    {
        return $this->markdown('mails.user.password-reset', [
            'user' => $this->user,
        ]);
    }
}

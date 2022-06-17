<?php

namespace App\Mail\User;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisteredWithoutVerificationMail extends Mailable
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
        $subject = __('mails.user.registered_without_verification.subject', [
            'appName' => config('app.name'),
        ]);

        $this->subject = $subject;
    }

    public function build(): self
    {
        return $this->markdown('mails.user.registered-without-verification', [
            'user' => $this->user,
        ]);
    }
}

<?php

namespace App\Notifications\User;

use App\Mail\User\ForgottenPasswordMail;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ForgottenPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var PasswordReset
     */
    private $passwordReset;

    public function __construct(PasswordReset $passwordReset)
    {
        $this->passwordReset = $passwordReset;
    }

    public function via(User $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(User $notifiable): ForgottenPasswordMail
    {
        return (new ForgottenPasswordMail($notifiable, $this->passwordReset))
            ->to($notifiable->email);
    }

    public function toArray(User $notifiable): array
    {
        return [
            //
        ];
    }
}

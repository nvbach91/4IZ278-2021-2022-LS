<?php

namespace App\Notifications\User;

use App\Mail\User\RegisteredMail;
use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class RegisteredNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var EmailVerification
     */
    private $verification;

    public function __construct(EmailVerification $verification)
    {
        $this->verification = $verification;
    }

    public function via(User $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(User $notifiable): RegisteredMail
    {
        return (new RegisteredMail($notifiable, $this->verification))
            ->to($notifiable->email);
    }

    public function toArray(User $notifiable): array
    {
        return [
            //
        ];
    }
}

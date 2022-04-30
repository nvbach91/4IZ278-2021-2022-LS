<?php

namespace App\Notifications\User;

use App\Mail\User\UserRegisteredMail;
use App\Models\EmailVerification;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class UserRegisteredNotification extends Notification implements ShouldQueue
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

    public function toMail(User $notifiable): UserRegisteredMail
    {
        return (new UserRegisteredMail($notifiable, $this->verification))
            ->to($notifiable->email);
    }

    public function toArray(User $notifiable): array
    {
        return [
            //
        ];
    }
}

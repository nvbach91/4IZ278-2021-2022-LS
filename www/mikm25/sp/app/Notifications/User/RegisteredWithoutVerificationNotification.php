<?php

namespace App\Notifications\User;

use App\Mail\User\RegisteredWithoutVerificationMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class RegisteredWithoutVerificationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function via(User $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(User $notifiable): RegisteredWithoutVerificationMail
    {
        return (new RegisteredWithoutVerificationMail($notifiable))
            ->to($notifiable->email);
    }

    public function toArray(User $notifiable): array
    {
        return [
            //
        ];
    }
}

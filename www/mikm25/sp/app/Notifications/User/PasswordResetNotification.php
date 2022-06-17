<?php

namespace App\Notifications\User;

use App\Mail\User\PasswordResetMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class PasswordResetNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via(User $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(User $notifiable): PasswordResetMail
    {
        return (new PasswordResetMail($notifiable))
            ->to($notifiable->email);
    }

    public function toArray(User $notifiable): array
    {
        return [
            //
        ];
    }
}

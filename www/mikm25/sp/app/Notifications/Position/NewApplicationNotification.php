<?php

namespace App\Notifications\Position;

use App\Mail\Position\NewApplicationMail;
use App\Models\Position;
use App\Models\PositionApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewApplicationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var PositionApplication
     */
    private $application;

    public function __construct(PositionApplication $application)
    {
        $this->application = $application;
    }

    public function via(Position $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(Position $notifiable): NewApplicationMail
    {
        $notifiable->loadMissing([
            'user',
        ]);

        return (new NewApplicationMail($notifiable, $this->application))
            ->to($notifiable->user->email);
    }

    public function toArray(Position $notifiable): array
    {
        return [
            //
        ];
    }
}

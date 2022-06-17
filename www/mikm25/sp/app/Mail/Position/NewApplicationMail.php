<?php

namespace App\Mail\Position;

use App\Enums\PositionTabEnum;
use App\Models\Position;
use App\Models\PositionApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewApplicationMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * @var PositionApplication
     */
    private $application;

    /**
     * @var Position
     */
    private $position;

    public function __construct(Position $position, PositionApplication $application)
    {
        $this->application = $application;
        $this->position = $position;

        /** @var string $subject */
        $subject = __('mails.position.new_application.subject', [
            'appName' => config('app.name'),
        ]);

        $this->subject = $subject;
    }

    public function build(): self
    {
        return $this->markdown('mails.position.new-application', [
            'application' => $this->application,
            'position' => $this->position,
            'action' => route('app.positions.show', [
                'position' => $this->position->id,
                'tab' => PositionTabEnum::applications()->getValue(),
            ]),
        ]);
    }
}

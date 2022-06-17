<?php

namespace App\Providers;

use App\Models\Position;
use App\Observers\PositionObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string,array<int,class-string>>
     */
    protected $listen = [];

    /**
     * @var array<class-string<Model>,class-string>
     */
    private $observers = [
        Position::class => PositionObserver::class,
    ];

    public function boot(): void
    {
        $this->bootObservers();
    }

    private function bootObservers(): void
    {
        foreach ($this->observers as $model => $observer) {
            $model::observe($observer);
        }
    }
}

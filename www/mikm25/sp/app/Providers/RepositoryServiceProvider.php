<?php

namespace App\Providers;

use App\Repositories\EmailVerification\EmailVerificationRepository;
use App\Repositories\EmailVerification\EmailVerificationRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * @var array<class-string,class-string>
     */
    private $repositories = [
        UserRepositoryInterface::class => UserRepository::class,
        EmailVerificationRepositoryInterface::class => EmailVerificationRepository::class,
    ];

    public function register(): void
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->singleton($interface, $implementation);
        }
    }

    /**
     * @return list<class-string>
     */
    public function provides(): array
    {
        return array_keys($this->repositories);
    }
}

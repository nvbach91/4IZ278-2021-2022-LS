<?php

namespace App\Providers;

use App\Repositories\EmailVerification\EmailVerificationRepository;
use App\Repositories\EmailVerification\EmailVerificationRepositoryInterface;
use App\Repositories\PasswordReset\PasswordResetRepository;
use App\Repositories\PasswordReset\PasswordResetRepositoryInterface;
use App\Repositories\Position\PositionRepository;
use App\Repositories\Position\PositionRepositoryInterface;
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
        PasswordResetRepositoryInterface::class => PasswordResetRepository::class,
        PositionRepositoryInterface::class => PositionRepository::class,
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

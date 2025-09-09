<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Filament\Dashboard\Pages\Auth\LoginResponse;
use App\Filament\Dashboard\Pages\Auth\LogoutResponse;
use Filament\Auth\Http\Responses\Contracts\LoginResponse as LoginResponseContract;
use Filament\Auth\Http\Responses\Contracts\LogoutResponse as LogoutResponseContract;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $this->app->bind(LogoutResponseContract::class, LogoutResponse::class);
        $this->app->bind(LoginResponseContract::class, LoginResponse::class);
    }
}

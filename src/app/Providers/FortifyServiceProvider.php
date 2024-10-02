<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\LoginController;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class FortifyServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->app->singleton(
        \Laravel\Fortify\Contracts\CreatesNewUsers::class,
        CreateNewUser::class
        );

        Fortify::createUsersUsing(CreateNewUser::class);

        Fortify::registerView(function () {
            return view('auth.register');
        });

        $this->app->singleton(
        \Laravel\Fortify\Contracts\AuthenticatesUsers::class,
        LoginController::class
    );

        Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::verifyEmailView(function () {
        return view('auth.thanks');
        });


        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(10)->by($email . $request->ip());
        });

    }
}

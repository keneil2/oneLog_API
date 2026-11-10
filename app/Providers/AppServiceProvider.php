<?php

declare(strict_types=1);

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        // creating custom verification Url..
        VerifyEmail::createUrlUsing(function($notifiable){
          
           $verificationUrl = URL::temporarySignedRoute(
            "verification.verify",
            Carbon::now()->addMinutes(Config::get("auth.verification.expire",60)),
    [
        "id"=>$notifiable->getKey(),
        "hash"=>sha1($notifiable->getEmailForVerification())
    ]    
           );
           return config("app.frontend_url")."/verification?verification_url=".urlencode($verificationUrl);
        });


        Model::shouldBeStrict(! app()->isProduction());
        Model::unguard();
    }
}

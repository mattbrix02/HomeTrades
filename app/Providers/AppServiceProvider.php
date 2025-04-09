<?php

namespace App\Providers;


use App\Models\Listing;
use App\Policies\ListingPolicy;
use App\Policies\NotificationPolicy;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;

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
        Gate::policy(DatabaseNotification::class, NotificationPolicy::class);
        Gate::policy(Listing::class, ListingPolicy::class);

        /*
        if($this->app->environment('production')){
            URL::forceScheme('https');
        }
            */
    }
}

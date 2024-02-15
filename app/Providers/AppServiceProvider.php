<?php

namespace App\Providers;


use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

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
        if (\App::environment(['production']) || \App::environment(['develop'])){
            \URL::forceScheme('https');
        }

        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            if (auth()->user()->isAdmin == 2){
                $event->menu->remove('menu1_admin_only');
            }
        });
    }
}

<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        // isAdmin(role)が10の場合、管理メニューを消す
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            if (auth()->user()->isAdmin == 10){
                // adminlte menuのキー(menu1_admin_only)で管理メニューを消す
                $event->menu->remove('menu1_admin_only');
                $event->menu->remove('menu2_admin_only');

            // ここから検証
            }elseif(auth()->user()->isAdmin == null){
                return redirect('/');
            }
            
        });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}

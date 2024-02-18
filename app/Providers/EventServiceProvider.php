<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\Auth;


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

if(auth()->user()->isAdmin == null){
                // return redirect('/');
                // dd($this->middleware('guest')->except('logout'));
                // $this->middleware('guest')->except('logout');
                Auth::logout();

                session()->invalidate();
            
                session()->regenerateToken();
            
                return redirect('/');
            }


if(auth()->user()->id == null){
                // return redirect('/');
                // dd($this->middleware('guest')->except('logout'));
                // $this->middleware('guest')->except('logout');
                Auth::logout();

                session()->invalidate();
            
                session()->regenerateToken();
            
                return redirect('/');
            }



        // isAdmin(role)が10の場合、管理メニューを消す
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            if (auth()->user()->isAdmin == 10){
                // adminlte menuのキー(menu1_admin_only)で管理メニューを消す
                $event->menu->remove('menu1_admin_only');
                $event->menu->remove('menu2_admin_only');

            }


            if (auth()->user()->isAdmin != 2){
                // adminlte menuのキー(menu2_admin_only)で管理メニューを消す                
$event->menu->remove('menu2_admin_only');
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

<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Compose a list of Roles
        View::composer(
            'collaborators.__form', 'App\Http\View\Composers\RoleComposer'
        );

        // Compose a list of Cities
        View::composer(
            'collaborators.__form', 'App\Http\View\Composers\CityComposer'
        );
    }
}

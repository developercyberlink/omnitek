<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SidebarHomeComposerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->composeSidebarHome();
    }

    public function composeSidebarHome(){
          view()->composer('themes.default.common.sidebar','App\Http\ViewComposers\SidebarHomeComposer');
    }
}

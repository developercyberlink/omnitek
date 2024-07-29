<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SidebarInnerComposerProvider extends ServiceProvider
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
        $this->composeSidebarInner();
    }

    public function composeSidebarInner(){
          view()->composer('themes.default.common.sidebar','App\Http\ViewComposers\SidebarInnerComposer');
    }
}

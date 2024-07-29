<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SidebarResourceLibraryComposerProvider extends ServiceProvider
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
        $this->composeSidebarResourceLibrary();
    }

    public function composeSidebarResourceLibrary(){
          view()->composer('themes.default.sidebar-resource','App\Http\ViewComposers\SidebarResourceLibraryComposer');
    }
}



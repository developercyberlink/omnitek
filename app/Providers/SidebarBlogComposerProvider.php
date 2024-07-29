<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SidebarBlogComposerProvider extends ServiceProvider
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
        $this->composeSidebarBlog();
    }

    public function composeSidebarBlog(){
          view()->composer('themes.default.sidebar-blog','App\Http\ViewComposers\SidebarBlogComposer');
    }
}

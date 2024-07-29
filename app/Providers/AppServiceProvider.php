<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Settings\SettingModel;
use App\Models\Settings\CountryModel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $setting = SettingModel::where('id', 1)->first();
        $country = CountryModel::get();
        View::share(['setting' => $setting, 'country' => $country]);

    }
}

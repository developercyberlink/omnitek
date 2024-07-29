<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\view;
use App\Models\Posts\PostTypeModel;
use App\Models\Posts\PostModel;
use App\Models\Settings\SettingModel;

class HeaderComposer
{

    public function __construct()
    {
        // Dependencies automatically resolved by service container...
    }

    public function compose(View $view)
    {
        $view->with('navigations', PostTypeModel::where(['is_menu' => '1'])
            ->orderBy('ordering', 'asc')
            ->get());

        $view->with('notice', PostModel::where(['post_parent' => '17', 'show_in_home' => '1'])
            ->orderBy('post_order', 'asc')
            ->get());

        $view->with('career', PostModel::where(['id' => '110'])
            ->orderBy('post_order', 'asc')
            ->first());

        $view->with('contact', PostTypeModel::where(['id' => '20'])
            ->orderBy('ordering', 'asc')
            ->first());


    }

}

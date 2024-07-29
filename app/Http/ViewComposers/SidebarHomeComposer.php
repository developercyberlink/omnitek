<?php

namespace App\Http\ViewComposers;

use App\Models\Posts\PostTypeModel;
use Illuminate\Contracts\View\view;
use App\Models\Posts\PostModel;
use App\Models\Settings\SettingModel;

class SidebarHomeComposer{

	public function __construct()
    {
        // Dependencies automatically resolved by service container...
    }

	public function compose(View $view){

		 $view->with('services', PostModel::where(['post_type' => '40','post_parent' => '0'])
		 	->first());

	}

}

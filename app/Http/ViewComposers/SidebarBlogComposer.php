<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\view;
use App\Models\Posts\PostModel;
use App\Models\Settings\SettingModel;

class SidebarBlogComposer{

	public function __construct()
	{
        // Dependencies automatically resolved by service container...
	}

	public function compose(View $view){

		// $view->with('recent_updates', PostModel::where(['post_type'=>20])
		// ->get());
}

}
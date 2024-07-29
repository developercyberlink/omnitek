<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\view;
use App\Models\Posts\PostModel;
use App\Models\Settings\SettingModel;

class SidebarInnerComposer{

	public function __construct()
	{
        // Dependencies automatically resolved by service container...
	}

	public function compose(View $view){

		$view->with('services', PostModel::where(['post_type'=>'2','post_parent'=>'0'])
			->orderBy('post_order','asc')
			->get());

		$view->with('downloads', PostModel::where(['post_type'=>3])
			->orderBy('post_order','asc')
			->get());


	}

}
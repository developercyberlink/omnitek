<?php

namespace App\Http\ViewComposers;

use App\Models\Banners\BannerModel;
use App\Models\Posts\PostTypeModel;
use Illuminate\Contracts\View\view;
use App\Models\Posts\PostModel;
use App\Models\Settings\SettingModel;
use App\Models\Galleries\VideoGalleryModel;

class FrontpageComposer{

	 public function __construct()
    {
        // Dependencies automatically resolved by service container...
    }

	public function compose(View $view){
		$view->with('aboutus', PostModel::where(['post_type'=>9,'id'=>157])
			->first());

        $view->with('vehicles', PostTypeModel::where(['is_menu'=>'1','post_type'=>'Our Vehicles'])
            ->orderBy('ordering','asc')
            ->get());

        $view->with('package', PostTypeModel::where(['is_menu'=>'1','post_type'=>'Package'])
            ->orderBy('ordering','asc')
            ->get());

        $view->with('reviews', PostTypeModel::where(['is_menu'=>'0','post_type'=>'Clients Review'])
            ->orderBy('ordering','asc')
            ->get());


	}

}

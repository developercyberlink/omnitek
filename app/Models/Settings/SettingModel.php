<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class SettingModel extends Model
{
    protected $table = 'cl_settings';
    protected $fillable = ['site_name','num_of_inquiries','location1','location2','address2','website2','phone','phone2','email_primary','email_secondary','website','address','facebook_link','linkedin_link','youtube_link','twitter_link','instagram_link','location_link','signin_url','signup_url','experience','google_plus','meta_key','meta_description','google_map','welcome_title','welcome_text','copyright_text'];
}

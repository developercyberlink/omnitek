<?php

namespace App\Models\Newsletters;

use Illuminate\Database\Eloquent\Model;

class NewsletterSignupModel extends Model
{
    protected $table = 'newsletter_signup';
    protected $fillable = ['first_name','last_name','email','company','status'];
}

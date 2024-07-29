<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('checkRoles', function ($user) {
    $roles = Auth::user()->roles()->get()->pluck('id')->toArray();
    return in_array($user->id, $roles);
});

Gate::define('manage-users', function ($user) {
    return $user->hasAnyRoles(['SuperAdmin', 'Admin', 'Employee', 'General']);
});

Gate::define('SuperAdmin', function ($user) {
    return $user->hasRole('SuperAdmin', 'Admin', 'Employee', 'General');
});

Gate::define('Admin', function ($user) {
    return $user->hasAnyRole(['Admin', 'Employee']);
});

Gate::define('Employee', function ($user) {
    return $user->hasRole('Employee');
});

Gate::define('General', function ($user) {
    return $user->hasRole('General');
});


        //
    }
}

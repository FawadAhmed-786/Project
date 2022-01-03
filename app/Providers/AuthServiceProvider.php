<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin',function($user){
            return $user->hasRole('admin');
        });
      

        /* define a user role */
        Gate::define('isUser', function($user) {
            return $user->hasRole('user');
        });

        /* define a User Admin  role */
        Gate::define('isAllowUserAdmin', function($user) {
            return $user->hasAnyRoles(['admin','user']);
        });

        Gate::define('isCurrentUser',function($user, $data){
            return $user->id == $data->id;
        });
         Gate::define('isCurrentAdmin',function($user, $data){
            return $user->id == $data;
        });
    }
}

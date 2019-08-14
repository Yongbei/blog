<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as AuthGate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Post' => 'App\Policies\PostPolicy',  // Authorization  181212
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(AuthGate $gate)
    {
        $this->registerPolicies();

        // authorization 181212
        // 如果不是true, 會繼續 Policy 驗證
        // $gate->before(function($user){
        //     if ($user->isAdmin()){
        //         return true;
        //     }
        // });
    }
}

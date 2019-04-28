<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();


        //Gate for backend
        $gate->define('isAdmin',function($user){
            return $user->type === 'Admin';
        });

        $gate->define('isEmployee',function($user){
            return $user->type === 'Employee';
        });

        $gate->define('isAgent',function($user){
            return $user->type === 'Agent';
        });

        $gate->define('isSupplier',function($user){
            return $user->type === 'Supplier';
        });

        $gate->define('isMyAccount',function($user,$profileUser){
            return $user->id === $profileUser->id;
        });

        $gate->define('isManager',function($user){
            return $user->type === 'Manager';
        });

        Passport::routes();
        //
    }
}

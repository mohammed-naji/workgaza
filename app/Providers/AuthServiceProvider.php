<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        Gate::before(function($user) {
            if(!$user->role) return true;
        });

        foreach(Permission::all() as $p) {
            Gate::define($p->code, function ($admin) use ($p) {
                return $admin->role->permissions()->where('code', $p->code)->exists();
            });
        }

    }
}

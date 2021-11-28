<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\SharePolicy;
use App\Policies\ClaimPolicy;
use App\Policies\ItemPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model'	=> 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('create-share', [SharePolicy::class, 'create']);
        Gate::define('delete-share', [SharePolicy::class, 'delete']);
        Gate::define('create-claim', [ClaimPolicy::class, 'create']);
        Gate::define('delete-claim', [ClaimPolicy::class, 'delete']);
        Gate::define('delete-item', [ItemPolicy::class, 'delete']);
        Gate::define('update-item', [ItemPolicy::class, 'update']);
    }
}

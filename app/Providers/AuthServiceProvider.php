<?php

namespace App\Providers;

//use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Continuous_operation;
use App\Policies\ContinuousOperationPolicy;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
     protected $policies = [
    \App\Models\Continuous_operation::class => \App\Policies\ContinuousOperationPolicy::class,
];
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}

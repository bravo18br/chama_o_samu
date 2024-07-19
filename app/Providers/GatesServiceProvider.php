<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class GatesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('regras', function ($user, $tipo_acesso) {
            switch ($tipo_acesso) {
                case 'super-admin':
                    return in_array($user->role, [1]);
                case 'operacao':
                    return in_array($user->role, [1, 2, 4]);
                case 'user':
                    return in_array($user->role, [1, 3]);
                case 'samu-admin':
                    return in_array($user->role, [1, 4]);
                default:
                    return false;
            }
        });
    }
}

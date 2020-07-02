<?php

namespace App\Providers;
use App\Models\Product;
use App\Policies\ProductPolicy;
use App\User;
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
        Product::class => ProductPolicy::class,
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
        Gate::define('update-product', function ($user, $product){ // check user dang login
            return $user->id == $product->user_id; // id cua user dang Login oi user_id cua product
        });

        Gate::define('destroy-product', function ($user, $product){
            return $user->id == $product->user_id;
        });

        // Gate::define('')

        // Phân quyền 
        Gate::define('admins', function ($user){
            return $user->role == User::ROLE['admin'];
        });
        //
    }
}

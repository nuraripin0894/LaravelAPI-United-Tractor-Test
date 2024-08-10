<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ProductService;
use App\Services\ProductCategoryService;
use App\Services\AuthService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton(ProductService::class, function ($app) {
            return new ProductService();
        });
        $this->app->singleton(ProductCategoryService::class, function ($app) {
            return new ProductCategoryService();
        });
        $this->app->singleton(AuthService::class, function ($app) {
            return new AuthService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

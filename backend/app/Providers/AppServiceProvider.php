<?php

namespace App\Providers;

use App\Interfaces\Repositories\CartItemRepositoryInterface;
use App\Interfaces\Repositories\CartRepositoryInterface;
use App\Interfaces\Repositories\CheckoutRepositoryInterface;
use App\Interfaces\Repositories\CouponRepositoryInterface;
use App\Interfaces\Repositories\ProductRepositoryInterface;
use App\Interfaces\Services\ProductServiceInterface;
use App\Services\ProductService;
use App\Repositories\ProductRepository;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Services\CartServiceInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Repositories\CartItemRepository;
use App\Repositories\CartRepository;
use App\Repositories\CheckoutRepository;
use App\Repositories\CouponRepository;
use App\Repositories\UserRepository;
use App\Services\CartService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);

        $this->app->bind(CartServiceInterface::class, CartService::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);

        $this->app->bind(CartItemRepositoryInterface::class, CartItemRepository::class);

        $this->app->bind(CheckoutRepositoryInterface::class, CheckoutRepository::class);

        $this->app->bind(CouponRepositoryInterface::class, CouponRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}

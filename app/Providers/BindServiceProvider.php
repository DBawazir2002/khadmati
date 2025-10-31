<?php

namespace App\Providers;

use App\Interfaces\Category\ICategoryRepository;
use App\Interfaces\Category\ICategoryService;
use App\Interfaces\IAuthService;
use App\Interfaces\IBaseRepository;
use App\Interfaces\IPasswordResetService;
use App\Interfaces\Offer\IOfferRepository;
use App\Interfaces\Offer\IOfferService;
use App\Interfaces\Service\IServiceRepository;
use App\Interfaces\Service\IServiceService;
use App\Interfaces\User\IUserRepository;
use App\Interfaces\User\IUserService;
use App\Repositories\BaseRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\OfferRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use App\Services\CategoryService;
use App\Services\OfferService;
use App\Services\ResetPasswordService;
use App\Services\ServiceService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class BindServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(IAuthService::class, AuthService::class);
        $this->app->bind(IBaseRepository::class, BaseRepository::class);
        $this->app->bind(IPasswordResetService::class, ResetPasswordService::class);
        $this->app->bind(ICategoryRepository::class, function () {
            $repo = new CategoryRepository();
            $repo->setModel(\App\Models\Category::class);
            return $repo;
        });
        $this->app->bind(ICategoryService::class, CategoryService::class);
        $this->app->bind(IOfferRepository::class, function () {
            $repo = new OfferRepository();
            $repo->setModel(\App\Models\Offer::class);
            return $repo;
        });
        $this->app->bind(IOfferService::class, OfferService::class);
        $this->app->bind(IServiceRepository::class, function () {
            $repo = new ServiceRepository();
            $repo->setModel(\App\Models\Service::class);
            return $repo;
        });
        $this->app->bind(IServiceService::class, ServiceService::class);
        $this->app->bind(IUserRepository::class, function () {
            $repo = new UserRepository();
            $repo->setModel(\App\Models\User::class);
            return $repo;
        });
        $this->app->bind(IUserService::class, UserService::class);
    }
}

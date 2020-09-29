<?php

namespace App\Providers\API\V1;

use Illuminate\Support\ServiceProvider;

use App\Repositories\API\V1\Auth\AuthRepository;
use App\Repositories\API\V1\Interfaces\Auth\IAuthRepository;

use App\Repositories\API\V1\Auth\OtpRepository;
use App\Repositories\API\V1\Interfaces\Auth\IOtpRepository;

use App\Repositories\API\V1\Page\PageRepository;
use App\Repositories\API\V1\Interfaces\Page\IPageRepository;

use App\Repositories\API\V1\Notification\NotificationRepository;
use App\Repositories\API\V1\Interfaces\Notification\INotificationRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(IPageRepository::class, PageRepository::class);
        $this->app->bind(IOtpRepository::class, OtpRepository::class);
        $this->app->bind(IAuthRepository::class, AuthRepository::class);
        $this->app->bind(INotificationRepository::class, NotificationRepository::class);
    }
}

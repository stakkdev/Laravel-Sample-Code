<?php

namespace App\Providers\API\V1;

use Illuminate\Support\ServiceProvider;

use App\Services\API\V1\Auth\AuthService;
use App\Services\API\V1\Interfaces\Auth\IAuthService;

use App\Services\API\V1\Auth\OtpService;
use App\Services\API\V1\Interfaces\Auth\IOtpService;

use App\Services\API\V1\Page\PageService;
use App\Services\API\V1\Interfaces\Page\IPageService;

use App\Services\API\V1\Notification\NotificationService;
use App\Services\API\V1\Interfaces\Notification\INotificationService;

class CustomServiceProvider extends ServiceProvider
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
        $this->app->bind(IOtpService::class, OtpService::class);
        $this->app->bind(IAuthService::class, AuthService::class);
        $this->app->bind(IPageService::class, PageService::class);
        $this->app->bind(INotificationService::class, NotificationService::class);
    }
}

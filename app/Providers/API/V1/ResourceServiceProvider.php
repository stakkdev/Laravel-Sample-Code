<?php

namespace App\Providers\API\V1;

use Illuminate\Http\Request;
use App\Http\Resources\API\V1\Handler;
use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\API\V1\ResourceHandler;
use App\Http\Resources\API\V1\Interfaces\IHandler;

class ResourceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IHandler::class, Handler::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        if ($request->wantsJson()) {
            $router = $this->app['\Illuminate\Routing\Router'];
            $kernel = $this->app['Illuminate\Contracts\Http\Kernel'];

            //router middleware
           // $router->pushMiddlewareToGroup('api', ResourceHandler::class);    
        }
    }
}

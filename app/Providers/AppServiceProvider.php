<?php

namespace App\Providers;

use App\Models\Request as ServiceRequest;
use App\Observers\RequestObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        ServiceRequest::observe(RequestObserver::class);
    }
}
<?php

namespace App\Providers;

use Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    if (env('APP_ENV') === 'production') {
      URL::forceScheme('https');
    }
    Gate::define('admin', function ($user) {
      return $user->isAdmin();
    });
    Gate::define('view-land', function ($user, $land) {
      return $user->isAdmin();
    });
  }
}

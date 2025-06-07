<?php

namespace App\Providers;

use Gate;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use League\Flysystem\Filesystem;
use League\Flysystem\AzureBlobStorage\AzureBlobStorageAdapter;

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

    \Storage::extend('azure-blob', function ($app, $config) {
      $client = BlobRestProxy::createBlobService(
        "DefaultEndpointsProtocol=https;AccountName={$config['name']};AccountKey={$config['key']}",
      );

      $adapter = new AzureBlobStorageAdapter($client, $config['container']);

      return new FilesystemAdapter(new Filesystem($adapter), $adapter, $config);
    });
  }
}

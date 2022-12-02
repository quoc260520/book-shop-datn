<?php

namespace App\Providers;
use App\Components\GoogleClient;
use Masbug\Flysystem\GoogleDriveAdapter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
class GoogleDriveServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            Storage::extend('google', function ($app, $config) {
                $options = [];
                $client = new GoogleClient(new \Google_Client());
                // $client->setApplicationName(env('GOOGLE_APP_ID'));
                // $client->setClientId($config['clientId']);
                // $client->setClientSecret($config['clientSecret']);
                // $client->refreshToken($config['refreshToken']);
                // $client->setAccessType('offline');
                // $client->setApprovalPrompt('force');
                // $tokens = $client->getAccessToken();
                // $client->setAccessToken($tokens);
                $service = new \Google\Service\Drive($client->getClient());
                $adapter = new GoogleDriveAdapter($service, $config['folder'] ?? '/', $options);
                $driver = new \League\Flysystem\Filesystem($adapter);

                return new \Illuminate\Filesystem\FilesystemAdapter($driver, $adapter);
            });
        } catch (\Exception $e) {
        }
    }
}
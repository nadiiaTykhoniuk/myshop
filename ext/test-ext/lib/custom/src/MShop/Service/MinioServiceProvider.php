<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class MinioServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('minio', function ($app, $config) {
            $client = new S3Client([
                'credentials' => [
                    'key' => 'minio_access_key',
                    'secret' => 'minio_secret_key'
                ],
                'region' => 'us-east-1',
                'version' => 'latest',
            ]);

            $options = [
                'override_visibility_on_copy' => true
            ];
            $adapter = new AwsS3Adapter($client, '', '', $options);
            $filesystem = new Filesystem($adapter);

            return  new $filesystem;

        });

    }
}

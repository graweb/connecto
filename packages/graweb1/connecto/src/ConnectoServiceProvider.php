<?php

namespace Graweb1\Connecto;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class ConnectoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/connecto.php');

        $this->loadViewsFrom(__DIR__.'/resources/views', 'connecto');

        $this->publishes([
            __DIR__.'/resources/css' => public_path('vendor/connecto/css'),
            __DIR__.'/resources/js' => public_path('vendor/connecto/js'),
            __DIR__.'/resources/views' => resource_path('views/vendor/connecto'),
        ], 'connecto-assets');

        $connections = [
            'db1' => [
                'driver' => env('DB_CONNECTION_1', 'mysql'),
                'host' => env('DB_HOST_1', '127.0.0.1'),
                'port' => env('DB_PORT_1', '3306'),
                'database' => env('DB_DATABASE_1', 'database1'),
                'username' => env('DB_USERNAME_1', 'username1'),
                'password' => env('DB_PASSWORD_1', 'password1'),
            ],
            'db2' => [
                'driver' => env('DB_CONNECTION_2', 'mysql'),
                'host' => env('DB_HOST_2', '127.0.0.1'),
                'port' => env('DB_PORT_2', '3306'),
                'database' => env('DB_DATABASE_2', 'database2'),
                'username' => env('DB_USERNAME_2', 'username2'),
                'password' => env('DB_PASSWORD_2', 'password2'),
            ]
        ];
        foreach ($connections as $name => $settings) {
            Config::set("database.connections.$name", [
                'driver' => $settings['driver'],
                'host' => $settings['host'],
                'port' => $settings['port'],
                'database' => $settings['database'],
                'username' => $settings['username'],
                'password' => $settings['password'],
            ]);
        }
    }
}

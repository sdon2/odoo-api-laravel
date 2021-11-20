<?php

namespace OdooAPILaravel;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use OdooAPI\OdooClient;

class OdooAPIServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/odoo-api.php' => config_path('odoo-api.php'),
        ]);
    }

    public function register()
    {
        $this->app->singleton(OdooClient::class, function () {
            return new OdooClient(Config::get('odoo-api.server_uri'), Config::get('odoo-api.username'), Config::get('odoo-api.password'), Config::get('odoo-api.db'));
        });
    }
}

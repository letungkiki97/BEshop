## LCRM

LCRM is a laravel based CRM.

## Install

### Install with install process

You just follow process install.

### Install using console

Install process look like this:

````composer install````

replace in file efriandika/laravel-settings/src/SettingsServiceProvider.php 

        $this->app['settings'] = $this->app->share(function ($app) { 
with

        $this->app->singleton('settings', function ($app) { 

````cp .env.example .env````

````php artisan key:generate````

open .env and enter database details

````php artisan migrate````

````php artisan db:seed````

````set chmod 777 in public/uploads folder and it's sub folders````

````set chmod 777 in public/pdf folder````

now you can access the website
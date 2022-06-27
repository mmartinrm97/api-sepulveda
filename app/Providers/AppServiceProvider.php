<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        config()->set('app.name','Laravel API');
        config()->set('database.connections.mysql.charset', 'utf8mb4');
        config()->set('database.connections.mysql.collation', 'utf8mb4_spanish_ci');

        //        Env Local
        if ($this->app->environment('local')) {
            config()->set('app.url', 'http://api-sepulveda.test');
        }

        //Env Develop
        if ($this->app->environment('develop')) {

            config()->set('app.url', 'https://develop.api-sepulveda.projectsdevmiller.website');

            config()->set('database.connections.mysql.host', 'localhost');

            config()->set('database.connections.mysql.database', 'projttgq_db_api_sepulveda_develop');
            config()->set('database.connections.mysql.username', 'projttgq_root_user_sepulveda');

            $this->app->bind('path.public', function () {

                return '/home/projttgq/public_html/develop.api-sepulveda.projectsdevmiller.website/public';
            });
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

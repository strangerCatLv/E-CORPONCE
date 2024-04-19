<?php

namespace App\Providers;

use App\Models\HistoryNotification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //d
    }

    /**
     * Bootstrap any application services.
     *ss
     * @return void
     */
    public function boot()
    {

        if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&  $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $this->app['request']->server->set('HTTPS', true);
        }

        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        Blade::directive('currency', function ( $expression ) { return "Rp. <?php echo number_format($expression,0,',','.'); ?>"; });
        
        // $this->app['request']->server->set('HTTPS', true);
        // URL::forceScheme('https');

    }
}

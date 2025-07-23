<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        // makes $guarded=[] in Model unneccessary
        Model::unguard();

        if ($this->app->environment('local')) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        $this->app->register(BuilderMacrosServiceProvider::class);

        // for debug bar loggin
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registeHttpClientMacros();

        $this->registerStrMacros();
    }

    public function registeHttpClientMacros()
    {

        // https://currency.getgeoapi.com/ site
        Http::macro('CurrencyConverter', function (): PendingRequest {

            return Http::baseUrl(
                config('services.currencty_converter.base_route')
            )
                ->withQueryParameters([
                    'api_key' => config('services.currencty_converter.api_key'),
                ]);
        });

    }

    public function registerStrMacros(): void
    {

        Str::macro('parseTimeStringFromInt', function (int $time): string {

            $time_as_string = strval($time);

            return
                strlen($time_as_string) === 1
                    ?
                    "0{$time_as_string}:00:00"
                    :
                    "{$time_as_string}:00:00";

        });

    }
}

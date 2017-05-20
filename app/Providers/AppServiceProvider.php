<?php

namespace App\Providers;

use Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setRequestMacros();
    }

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
     * Set request macros
     *
     * @return void
     */
    private function setRequestMacros()
    {
        /**
         * Return the value of the requested domain, if the current route is
         * defined inside of a group, that has a `{domain}` pattern as part
         * of its `domain` parameter. Othewise null will be returned.
         *
         * @return string|null
         */
        $determinateDomainClosure = function () {
            if (! array_key_exists('domain', $params = Request::route()->parameters)) {
                return null;
            }
            return $params['domain'];
        };

        // Extend request by adding a `site` macro into it. Macro is available
        // by calling the `site` static method on Request facade or instance
        // of \Illuminate\Http\Request object later in your application.
        Request::macro('site', $determinateDomainClosure);
    }
}

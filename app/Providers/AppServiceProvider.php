<?php

namespace App\Providers;

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
        /**
         * 视图composer共享数据
         */
        view()->composer(
            'layouts.partials.'.getTheme().'-sidebar', 'App\Http\ViewComposers\MenuComposer'
        );

        view()->composer(
            'layouts.iwanli.header', 'App\Http\ViewComposers\CategoryComposer'
        );

        view()->composer(
            'layouts.iwanli.link', 'App\Http\ViewComposers\FriendshipLinkComposer'
        );
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
}

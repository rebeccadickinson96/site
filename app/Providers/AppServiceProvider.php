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
        view()->composer('partials.sidebar', function($view){
            $view->with(['archives' => \App\Post::archives(),
                        'categories' => \App\Category::allCategories(),
                        'uncategorized' => \App\Post::noCategories()
            ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       
    }
}

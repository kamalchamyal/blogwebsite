<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Category;


class AppServiceProvider extends ServiceProvider
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

        Paginator::useBootstrap();
        // $category = Category::where("c_status", 1)->orderBy('id', 'DESC')->get();
        // $currentTimestamp = time();
        // $currentDateTime = date('d F. l Y. g:i A', $currentTimestamp);

        // View::share(['currentDateTime' => $currentDateTime, 'category' => $category]);
        // View::composer('errors.404', function ($view) {
        //     $category = Category::where("c_status", 1)->orderBy('id', 'DESC')->get();
        //     $currentTimestamp = time();
        //     $currentDateTime = date('d F. l Y. g:i A', $currentTimestamp);

        //     $view->with(['currentDateTime' => $currentDateTime, 'category' => $category]);
        // });
        View::composer(['frontend.header', 'frontend.footer'], function ($view) {
            $category = Category::where("c_status", 1)->orderBy('id', 'DESC')->get();
            $currentTimestamp = time();
            $currentDateTime = date('d F. l Y. g:i A', $currentTimestamp);

            $view->with('currentDateTime', $currentDateTime)->with('category', $category);
        });


    }
}

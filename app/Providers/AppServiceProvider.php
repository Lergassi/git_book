<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
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
        View::share("menu", [
            ["route" => "homepage", "label" => "ГЛАВНАЯ"],
            ["route" => "book.create", "label" => "СОЗДАТЬ КНИГУ"],
            ["route" => "homepage", "label" => "ПРОФИЛЬ"],
            ["route" => "book.index", "label" => "КНИГИ"],
            ["route" => "homepage", "label" => "О ПРОЕКТЕ"],
        ]);
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

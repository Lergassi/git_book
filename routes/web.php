<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$middleware = [];

if (Config::get('app.debug')) {
    $middleware[] = "clearcache";
}

Route::middleware($middleware)->group(function () {
    //frontend
    Route::get("/", "SiteController@homepage")->name("homepage");
    Route::resource("book", "BookController");
    Route::resource("chapter", "ChapterController")->except([
        "create", "index",
    ]);
    Route::get("chapter/create/{book}", "ChapterController@create")->name("chapter.create")->where("book", "\d+");
    Route::get("chapters/{book}", "ChapterController@index")->name("chapter.index")->where("book", "\d+");

    //backend
    Route::middleware(["isAdmin"])
        ->prefix("admin")
        ->namespace("Admin")
        ->name("admin.")
        ->group(function () {
        Route::resource("book", "BookController")->only([
            "show", "edit", "update", "index", "destroy",
        ]);
        Route::resource("chapter", "ChapterController")->only([
            "show", "edit", "update", "index", "destroy",
        ]);

        //test
        Route::get("test/html", "TestController@html");
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class Menu
{
    public function handle($request, Closure $next)
    {
        $menu = [
            ["route" => "homepage", "label" => "ГЛАВНАЯ"],
            ["route" => "book.create", "label" => "СОЗДАТЬ КНИГУ"],
            ["route" => "homepage", "label" => "О ПРОЕКТЕ"],
        ];

        if (!Auth::guest()) {
            array_splice($menu, 2, 0, [[
                "route" => "book.index", "label" => "МОИ КНИГИ",
            ]]);

            if (in_array(Auth::user()->id, config("app.adminsId"))) {
                $menu[] = [
                    "route" => "admin.homepage", "label" => "ADMIN",
                ];
            }
        } else {
            $menu = array_merge($menu, [
                ["route" => "login", "label" => "ВХОД",],
                ["route" => "register", "label" => "РЕГИСТРАЦИЯ",],
            ]);
        }

        View::share("menu", $menu);

        return $next($request);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function homepage()
    {
        if (Auth::guest())
            return view('site/homepage');
        else {
            $books = Auth::user()->books;

            return view("book/index", [
                "columns" => [
                    "title",
                    "description",
                    "created_at",
                ],
                "books" => $books,
            ]);
        }
    }
}

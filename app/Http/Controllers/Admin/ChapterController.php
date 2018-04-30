<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Chapter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChapterController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chapters = Chapter::orderBy("title", "ASC")->get();

        return view("admin/chapter/index", [
            "columns" => [
                "id",
                "title",
                "created_at",
                "book_id",
            ],
            "chapters" => $chapters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Chapter $chapter
     * @return \Illuminate\Http\Response
     * @internal param Book $book
     */
    public function show(Chapter $chapter)
    {
        return view("admin/chapter/show", [
            "chapter" => $chapter,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Chapter $chapter
     * @return \Illuminate\Http\Response
     * @internal param Book $book
     */
    public function edit(Chapter $chapter)
    {
        return view("admin/chapter/edit", [
            "chapter" => $chapter,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}

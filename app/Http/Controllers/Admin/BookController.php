<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
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
        $books = Book::orderBy("title", "ASC")->get();

        return view("admin/book/index", [
            "columns" => [
                "id",
                "title",
                "created_at",
                "author_id",
                "headCommit",
            ],
            "books" => $books,
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
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view("admin/book/show", [
            "book" => $book,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view("admin/book/edit", [
            "book" => $book,
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
        $validator = Book::createValidator($request->input());

        if ($validator->fails()) {
            return redirect()->route("admin.book.edit", ["book" => $book->id])
                ->withErrors($validator)
                ->withInput();
        }

        $book->title = $request->input("book.title");
        $book->description = $request->input("book.description");

        if ($book->save()) {
            return redirect()->route("admin.book.show", ["book" => $book->id]);
        } else {
            return redirect()->route("admin.book.edit", ["book" => $book->id])
                ->withErrors(["Ошибка при создании книги."])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if ($book->delete())
            return redirect()->route("admin.book.index");
        else
            return redirect()->route("admin.book.show", ["book" => $book->id])
                ->withErrors(["Ошибка при удалении книги."])
                ->withInput();
    }
}

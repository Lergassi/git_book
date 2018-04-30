<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->authorizeResource(Book::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::where("author_id", Auth::user()->id)->get();

        return view("book/index", [
            "columns" => [
                "title",
                "description",
                "created_at",
                "chapters",
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
        $book = new Book();

        return view("book/create", [
            "book" => $book,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = new Book();

        $validator = Book::createValidator($request->input());

        if ($validator->fails()) {
            return redirect()->route("book.create")
                ->withErrors($validator)
                ->withInput();
        }

        $book->title = $request->input("book.title");
        $book->description = $request->input("book.description");
        $book->author_id = Auth::user()->id;

        if ($book->save()) {
            return redirect()->route("book.show", ["book" => $book->id]);
        } else {
            return redirect()->route("book.create")
                ->withErrors(["Ошибка при создании книги."])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view("book/show", [
            "book" => $book,
        ]);
    }

    /**
     * TODO: Только для авторов книг!
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view("book/edit", [
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
            return redirect()->route("book.edit", ["book" => $book->id])
                ->withErrors($validator)
                ->withInput();
        }

        $book->title = $request->input("book.title");
        $book->description = $request->input("book.description");

        if ($book->save()) {
            return redirect()->route("book.show", ["book" => $book->id]);
        } else {
            return redirect()->route("book.edit", ["book" => $book->id])
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
            return redirect()->route("book.index");
        else
            return redirect()->route("book.show", ["book" => $book->id])
                ->withErrors(["Ошибка при удалении книги."])
                ->withInput();
    }
}

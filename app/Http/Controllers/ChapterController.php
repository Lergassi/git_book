<?php

namespace App\Http\Controllers;

use App\Book;
use App\Chapter;
use App\ChapterCopy;
use App\Commit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ChapterController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
//        $this->middleware("can:create,App\\Chapter,book");
//        $this->middleware("can:view,chapter");
//        $this->middleware("can:view,chapter");
//        $this->authorizeResource(Chapter::class);
//        unset($this->middleware[3]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Book $book
     * @return \Illuminate\Http\Response
     */
    public function index(Book $book)
    {
        $chapters = $book->chapters()->get();

        return view("chapter/index", [
            "columns" => [
                "id",
                "title",
                "created_at",
                "next_chapter_id",
            ],
            "chapters" => $chapters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Book $book
     * @return \Illuminate\Http\Response
     */
    public function create(Book $book)
    {
        $this->authorize('create', [Chapter::class, $book]);

        $chapter = new Chapter();
        $chapter->book_id = $book->id;

        return view("chapter/create", [
            "chapter" => $chapter,
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
        $chapter = new Chapter();

        $validator = Chapter::createValidator($request->input());

        if ($validator->fails()) {
            return redirect()->route("chapter.create", ["chapter" => $request->input("chapter.book_id")])
                ->withErrors($validator)
                ->withInput();
        }

        $chapter->title = $request->input("chapter.title");
        $chapter->text = $request->input("chapter.text");
        $chapter->book_id = $request->input("chapter.book_id");
        $chapter->status = Chapter::STATUS_ACTIVE;

        if ($chapter->save()) {
            return redirect()->route("chapter.show", ["chapter" => $chapter->id]);
        } else {
            return redirect()->route("chapter.create", ["chapter" => $chapter->book_id])
                ->withErrors(["Ошибка при создании главы."])
                ->withInput();
        }
    }

    /**
     * TODO: Настройка прав к неактивным главам
     * Display the specified resource.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function show(Chapter $chapter)
    {
        $this->authorize('view', $chapter);

        return view("chapter/show", [
            "chapter" => $chapter,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function edit(Chapter $chapter)
    {
        $this->authorize('update', [$chapter]);

        return view("chapter/edit", [
            "chapter" => $chapter,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chapter $chapter)
    {
        $validator = CHapter::createValidator($request->input());

        if ($validator->fails()) {
            return redirect()->route("chapter.edit", ["chapter" => $chapter->id])
                ->withErrors($validator)
                ->withInput();
        }

        $chapter->title = $request->input("chapter.title");
        $chapter->text = $request->input("chapter.text");
        //TODO: Сделать отдельный механизм для записи порядка глав
//        $chapter->next_chapter_id = $request->input("chapter.next_chapter_id");

        if ($chapter->save()) {

            return redirect()->route("chapter.show", ["chapter" => $chapter->id]);
        } else {
            return redirect()->route("chapter.edit", ["chapter" => $chapter->id])
                ->withErrors(["Ошибка при создании книги."])
                ->withInput();
        }
    }

    /**
     * @param  \App\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chapter $chapter)
    {
        $this->authorize('delete', [$chapter]);

        if ($chapter->inactive()) {
            return redirect()->route("book.show", ["book" => $chapter->book_id]);
        } else {
            return redirect()->route("chapter.show", ["chapter" => $chapter->id])
                ->withErrors(["При удалении главы произошла ошибка."]);
        }
    }
}

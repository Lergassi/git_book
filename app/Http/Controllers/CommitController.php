<?php

namespace App\Http\Controllers;

use App\Book;
use App\Commit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommitController extends Controller
{
    public function index(Book $book)
    {
        $commits = $book->commits;

        return view("commit/index", [
            "columns" => [
                "id",
                "created_at",
                "is_head",
                "next_commit_id",
            ],
            "commits" => $commits,
        ]);
    }

    public function create(Book $book)
    {
        $commit = Commit::create($book);

        if (!$commit)
            return redirect()->route("book.show", ["book" => $book->id])
                ->withErrors(["При создании коммита произошла ошибка."]);
        else
            return redirect()->route("book.show", ["book" => $book->id]);
    }

    public function show(Commit $commit)
    {
        return view("commit/show", [
            "commit" => $commit,
        ]);
    }

    public function checkout(Commit $commit)
    {
        $commit->checkout();

        return redirect()->route("book.show", [
            "book" => $commit->book->id
        ]);
    }

    public function fork(Book $book)
    {
        if (Gate::denies('fork', [Commit::class, $book])) {
            throw new \Exception("Вы не можете создать больше одной копии книги или копию своей книги.");
        }

        $newBook = Commit::fork($book, Auth::user());
        if ($newBook)
            return redirect()->route("book.show", ["book" => $newBook->id]);
        else
            return redirect()->route("book.show", ["book" => $book->id])->withErrors(["Ошибка при создании копии книги."]);
    }
}

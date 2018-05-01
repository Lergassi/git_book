<?php

namespace App\Http\Controllers;

use App\Book;
use App\Commit;
use Illuminate\Http\Request;

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
}

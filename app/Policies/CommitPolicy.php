<?php

namespace App\Policies;

use App\User;
use App\Book;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommitPolicy
{
    use HandlesAuthorization;

    public function fork(User $user, Book $book)
    {
        $childBook = Book::where("parent_book_id", $book->id)->where("author_id", $user->id)->count();

        return !$childBook && $book->author_id != $user->id;
    }
}

<?php

namespace App\Policies;

use App\Book;
use App\User;
use App\Chapter;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChapterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the chapter.
     *
     * @param  \App\User  $user
     * @param  \App\Chapter  $chapter
     * @return mixed
     */
    public function view(User $user, Chapter $chapter)
    {
        return true;
    }

    /**
     * Determine whether the user can create chapters.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, Book $book)
    {
        return $user->id == $book->author_id;
    }

    /**
     * Determine whether the user can update the chapter.
     *
     * @param  \App\User  $user
     * @param  \App\Chapter  $chapter
     * @return mixed
     */
    public function update(User $user, Chapter $chapter)
    {
        return $this->isAuthor($user, $chapter);
    }

    /**
     * Determine whether the user can delete the chapter.
     *
     * @param  \App\User  $user
     * @param  \App\Chapter  $chapter
     * @return mixed
     */
    public function delete(User $user, Chapter $chapter)
    {
        return $this->isAuthor($user, $chapter);
    }

    public function isAuthor(User $user, Chapter $chapter)
    {
        return $user->id == $chapter->book->author_id;
    }
}

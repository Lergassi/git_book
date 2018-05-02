<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Commit extends Model
{
    protected $table = "commits";

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * Переключает активные главы на коммит объекта.
     * @return bool
     */
    public function checkout()
    {
        DB::beginTransaction();
        $success = true;
        $head = static::head($this->book);

        if ($head->id == $this->id) {
            return false;
        }

        $chaptersCopies = $this->chaptersCopies;

        foreach ($chaptersCopies as $chapterCopy) {
            $chapterCopy->revert();
        }

        static::resetHead($this, $head);

        $success = $head->save() && $success;
        $success = $this->save() && $success;

        if ($success) {
            DB::commit();
        } else {
            DB::rollback();
        }

        return $success;
    }

    /**
     * Меняет местами указатель на последний коммит. Без сохранения.
     * @param Commit $newCommit
     * @param Commit $prevCommit
     */
    public static function resetHead(Commit $newCommit, Commit $prevCommit)
    {
        $newCommit->is_head = 1;
        $prevCommit->is_head = 0;
    }

    /**
     * Возвращает последний коммит.
     * @param Book $book
     * @return mixed
     */
    public static function head(Book $book)
    {
        $commit = Commit::where("book_id", $book->id)->where("is_head", true)->first();

        return $commit;
    }

    /**
     * Создает коммит. С сохранением всех сущностей. Можно вызвать из любого места проекта.
     * @param Book $book
     * @return Commit|bool
     */
    public static function create(Book $book)
    {
        DB::beginTransaction();
        $success = true;

        $chapters = $book->chapters;
        $copies = ChapterCopy::copies($chapters);

        $commit = new Commit();

        $commit->book_id = $book->id;
        $commit->is_head = true;
        $head = static::head($book);

        $success = $commit->save() && $success;

        if ($head) {
            $head->is_head = false;
            $head->next()->attach($commit->id);
            $success = $head->save() && $success;
        }

        foreach ($copies as $copy) {
            $copy->commit_id = $commit->id;

            $success = $copy->save() && $success;
        }

        if ($success) {
            DB::commit();

            return $success;
        } else {
            DB::rollback();

            return $commit;
        }
    }

    public function chaptersCopies()
    {
        return $this->hasMany("App\\ChapterCopy", "commit_id", "id");
    }

    public function book()
    {
        return $this->hasOne("App\\Book", "id", "book_id");
    }

    public function next()
    {
        return $this->belongsToMany("App\\Commit", "commit_to_commit", "commit_id", "commit_child_id");
    }

    /**
     * Создаёт копии всех сущностей связанных с книгой.
     * @param Book $book
     * @param User $user
     * @return bool|Model
     */
    public static function fork(Book $book, User $user)
    {
        DB::beginTransaction();

        $success = true;

        $newBook = $book->replicate();
        $newBook->author_id = $user->id;
        $newBook->parent_book_id = $book->id;
        $success = $newBook->save() && $success;

        $chaptersLinks = [];
        $chapters = $book->chapters;
        foreach ($chapters as $chapter) {
            $newChapter = $chapter->replicate();
            $newChapter->book_id = $newBook->id;
            $success = $newChapter->save() && $success;
            $chaptersLinks[$chapter->id] = $newChapter->id;
        }

        $commitsLinks = [];
        $commits = $book->commits;
        foreach ($commits as $commit) {
            $newCommit = $commit->replicate();
            $newCommit->book_id = $newBook->id;
            $success = $newCommit->save() && $success;
            $commitsLinks[$commit->id] = $newCommit->id;
        }

        $commitsEdges = CommitToCommit::whereIn("commit_id", array_keys($commitsLinks))->get();
        foreach ($commitsEdges as $commitEdge) {
            $newCommitEdge = $commitEdge->replicate();
            $newCommitEdge->commit_id = $commitsLinks[$newCommitEdge->commit_id];
            $newCommitEdge->commit_child_id = $commitsLinks[$newCommitEdge->commit_child_id];
            $success = $newCommitEdge->save() && $success;
        }

        $chaptersCopies = ChapterCopy::where("chapter_book_id", $book->id)->get();
        foreach ($chaptersCopies as $copy) {
            $newCopy = $copy->replicate();
            $newCopy->chapter_id = $chaptersLinks[$copy->chapter_id];
            $newCopy->chapter_book_id = $newBook->id;
            $newCopy->commit_id = $commitsLinks[$copy->commit_id];
            $success = $newCopy->save() && $success;
        }

        if ($success) {
            DB::commit();
            return $newBook;
        } else {
            DB::rollback();
            return $success;
        }
    }
}

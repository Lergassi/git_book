<?php

namespace App;

use Validator;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string $title
 * @property string $text
 * @property int $book_id
 * @property int $next_chapter_id
 * Class Chapter
 * @package App
 */
class Chapter extends Model
{
    protected $table = "chapters";

    public static function createValidator(array $attributes)
    {
        return Validator::make($attributes, [
            "chapter.title" => "string|max:256",
        ]);
    }

    public function book()
    {
        return $this->hasOne("App\\Book", "id", "book_id");
    }

    /**
     * Записывает порядок глав для быстрого доступа. Обновляет все главы.
     */
    public function sort()
    {

    }

    public function prevChapter()
    {

    }

    public function nextChapter()
    {

    }

    public function firstChapter()
    {

    }

    public function lastChapter()
    {

    }
}

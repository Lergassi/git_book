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
 * @property int $status
 * Class Chapter
 * @package App
 */
class Chapter extends Model
{
    const STATUS_INACTIVE = 10;
    const STATUS_ACTIVE = 20;

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

    /**
     * "Удаляет" главу.
     * @return bool
     */
    public function inactive()
    {
        $this->status = self::STATUS_INACTIVE;

        return $this->save();
    }

    /**
     * Восстанавливает главу.
     * @return bool
     */
    public function active()
    {
        $this->status = self::STATUS_ACTIVE;

        return $this->save();
    }
}

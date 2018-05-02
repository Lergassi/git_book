<?php

namespace App;

use const Grpc\CHANNEL_READY;
use Validator;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property string $title
 * @property string $description
 * @property int $author_id
 * Class Book
 * @package App
 */
class Book extends Model
{
    protected $table = "books";

    public static function createValidator(array $attributes)
    {
        return Validator::make($attributes, [
            "book.title" => "required|string|max:256",
            "book.description" => "required|string|max:512",
        ]);
    }

    /**
     * Только активные главы.
     * @return $this
     */
    public function chapters()
    {
        return $this->hasMany("App\\Chapter")->where("status", "=", Chapter::STATUS_ACTIVE);
    }

    /**
     * Все главы, в том числе которые в данный момент не активны ("удалены").
     * @return $this
     */
    public function allChapters()
    {
        return $this->hasMany("App\\Chapter")->where("status", "=", Chapter::STATUS_ACTIVE);
    }

    public function headCommit()
    {
        return Commit::head($this);
    }

    public function commits()
    {
        return $this->hasMany("App\\Commit", "book_id", "id");
    }
}

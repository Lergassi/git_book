<?php

namespace App;

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

    public function chapters()
    {
        return $this->hasMany("App\\Chapter");
    }
}

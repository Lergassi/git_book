<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ChapterCopy extends Model
{
    protected $table = "chapters_copies";

    public static function copy(Chapter $chapter): ChapterCopy
    {
        $chapterCopy = new ChapterCopy();

        $chapterCopy->chapter_id = $chapter->id;

        foreach (static::getAttributesForCopy() as $attribute) {
            $copyAttributeName = "chapter_" . $attribute;
            $chapterCopy->$copyAttributeName = $chapter->$attribute;
        }

        return $chapterCopy;
    }

    public static function copies(Collection $chapters)
    {
        $result = [];
        foreach ($chapters as $chapter) {
            $result[] = static::copy($chapter);
        }

        return $result;
    }

    public function revert()
    {
        $chapter = $this->chapter;

        foreach (static::getAttributesForCopy() as $attribute) {
            $copyAttributeName = "chapter_" . $attribute;
            $chapter->$attribute = $this->$copyAttributeName;
        }

        return $chapter->save();
    }

    public static function getCopies(Chapter $chapter, Commit $commit = null)
    {
        $copy = ChapterCopy::where("chapter_id", $chapter->id)->first();

        return $copy;
    }

    public function chapter()
    {
        return $this->hasOne("App\\Chapter", "id", "chapter_id");
    }

    public static function getAttributesForCopy()
    {
        return [
            "created_at",
            "updated_at",
            "title",
            "text",
            "book_id",
            "status",
        ];
    }
}

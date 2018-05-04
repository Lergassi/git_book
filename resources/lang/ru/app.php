<?php

return [
    "id" => "ID",
    "created_at" => "Дата создания",
    "updated_at" => "Дата обновления",
    "book" => [
        "title" => "Название",
        "description" => "Описание",
        "author_id" => "Автор",
        "chapters" => "Главы",
    ],
    "chapter" => [
        "title" => "Заголовок",
        "text" => "Текст",
        "book_id" => "Книга",
        "status" => "Статус",
    ],
    "commit" => [
        "book_id" => "Книга",
        "is_head" => "Последняя версия",
    ],
];
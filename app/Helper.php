<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Helper
{

    /**
     * Обертка для trans(). Если поле не найдено, поиск происходит в файле lang/@lang/app.php. Переменные в validation указываются как trans(model.attribute)
     * @param null $key
     * @param array $replace
     * @param null $locale
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    public static function trans($key = null, $replace = [], $locale = null)
    {
        $trans = app('translator');

        if ($trans->has($key))
            return trans($key, $replace, $locale);
        else {
            if ($trans->has("app." . $key)) {
                return trans("app." . $key);
            }

            $keys = explode(".", $key);
            $keyNew = $keys[count($keys) - 1];

            return trans("app." . $keyNew);
        }
    }

    /**
     * Возвращает значение атрибута модели или поле из запроса если оно заполнено. Нотация с точкой (model.attribute).
     * @param Model $model
     * @param $attribute
     * @return mixed|string
     */
    public static function value(Model $model, $attribute)
    {
        if (old()) {
            return old($attribute);
        } else {
            $modelAttribute = Helper::getLastDotKey($attribute);

            return $model->$modelAttribute;
        }
    }

    /**
     * Возвращает последний компонент названия поля (название атрибута модели).
     * @param string $key
     * @return mixed
     */
    public static function getLastDotKey(string $key)
    {
        $segments = explode(".", $key);

        return $segments[count($segments) - 1];
    }

    /**
     * Для формирования массива attributes для validation.
     * @param array $modelNames
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    public static function getAttributesNames(array $modelNames)
    {
        $result = [];

        foreach ($modelNames as $modelName) {
            $result += trans("app." . $modelName);
        }

        return $result;
    }
}
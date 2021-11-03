<?php


namespace app\core\form;


use app\core\Model;

class Form
{
    public static function begin($action, $method) {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public static function end() {
        echo '</form>';
    }

    /**
     * Return a new field object for specified attribute & model.
     * @param Model $model
     * @param $attribute
     * @return Field
     */
    public function field(Model $model, $attribute ) {
        return new Field($model, $attribute);
    }
}
<?php

namespace Core\Models;

abstract class BaseModel
{
    public static $relations = [];

    public function bootRelations()
    {
        $c = get_called_class();
        foreach ($c::$relations as $relation) {
            if (method_exists($this, $relation)) {
                $this->$relation();
            }
        }
    }

}
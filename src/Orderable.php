<?php

namespace ZigaStrgar\Orderable;


trait Orderable
{
    public static function bootOrderable()
    {
        static::addGlobalScope(new OrderingScope);
    }

    abstract public function orderable();
}
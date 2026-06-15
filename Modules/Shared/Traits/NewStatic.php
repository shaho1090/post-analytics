<?php

namespace Shared\Traits;

trait NewStatic
{
    public static function new(): static
    {
        return new static();
    }
}

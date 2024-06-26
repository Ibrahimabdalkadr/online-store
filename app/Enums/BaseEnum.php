<?php

namespace App\Enums;

use Illuminate\Support\Str;

trait BaseEnum
{
    public static function get(int $value): array
    {
        return (array)self::from($value);
    }

    public static function fromName(string $name)
    {
        if (!defined("self::$name"))
            $name = Str::upper($name);
        return constant("self::$name");
    }
    public static function is(int $value, string $name)
    {
        return self::fromName($name)->value === $value;
    }

    public static function namesArray()
    {
        return  array_column(self::cases(), 'name');
    }

    public static function valuesArray()
    {
        return self::cases();
    }
}

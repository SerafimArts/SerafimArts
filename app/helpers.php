<?php
if (!function_exists('resource_path')) {
    function resource_path($path = '')
    {
        return base_path('resources/' . $path);
    }
}

if (!function_exists('is_uuid')) {
    function is_uuid($value)
    {
        return is_string($value) &&
            strlen($value) === 36 &&
            preg_match('/[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}/', $value);
    }
}

if (!function_exists('enum_of')) {
    /**
     * @param mixed $value
     * @param string|\MyCLabs\Enum\Enum $enum
     * @return bool
     */
    function enum_of($value, string $enum) {
        return is_subclass_of($enum, \MyCLabs\Enum\Enum::class) && $enum::isValid($value);
    }
}
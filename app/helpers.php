<?php
if (!function_exists('resource_path')) {
    function resource_path($path = '')
    {
        return base_path('resources/' . $path);
    }
}

if (!function_exists('asset_ts')) {
    function asset_ts($path = '')
    {
        $link = '/assets/' . $path;
        return $link . '?' . filemtime(public_path($link));
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
     * @param string|\MabeEnum\Enum $enum
     * @return bool
     */
    function enum_of($value, string $enum) {
        return
            is_subclass_of($enum, \MabeEnum\Enum::class) &&
            $enum::has($value);
    }
}
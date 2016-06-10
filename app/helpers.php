<?php
if (!function_exists('resource_path')) {
    function resource_path($path = '')
    {
        return base_path('resources/' . $path);
    }
}
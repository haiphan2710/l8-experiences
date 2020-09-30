<?php

/**
 * For add 'active' class for activated route nav-item
 *
 * @param array $path
 * @param string $active
 * @return string
 */
function activeClass(array $path, string $active = 'active')
{
    return call_user_func_array('Request::is', $path) ? $active : '';
}

/**
 * For checking activated route
 *
 * @param $path
 * @return string
 */
function isActiveRoute($path)
{
    return call_user_func_array('Request::is', (array)$path) ? 'true' : 'false';
}

/**
 * For add 'show' class for activated route collapse
 *
 * @param $path
 * @return string
 */
function showClass($path)
{
    return call_user_func_array('Request::is', (array)$path) ? 'show' : '';
}

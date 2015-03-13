<?php


/**
 * Set or get session item
 *
 * @param string $key
 * @param mixed $value
 *
 * @return mixed
 */
function session($key, $value = null)
{
    return ($value === null)
        ? Discord\Persist\Session::get($key)
        : Discord\Persist\Session::set($key, $value);
}


/**
 * Set or get flash message
 *
 * @param string $key
 * @param mixed $value
 *
 * @return mixed
 */
function flash($key, $value = null)
{
    return ($value === null)
        ? Discord\Persist\Flash::get($key)
        : Discord\Persist\Flash::set($key, $value);
}


/**
 * Get auth data
 *
 * @return object
 */
function auth()
{
    return (object)[
        'rank' => Discord\Persist\Auth::rank(),
        'user' => Discord\Persist\Auth::user()
    ];
}
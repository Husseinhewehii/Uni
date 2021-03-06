<?php

if (! function_exists('route')) {
    /**
     * Generate the URL to a named route.
     *
     * @param  array|string  $name
     * @param  mixed  $parameters
     * @param  bool  $absolute
     * @return string
     */

    function route($name, $parameters = [], $absolute = true)
    {
        if (!isset($parameters['lang'])) {
            $parameters['lang'] = app()->getLocale();
        }
        return app('url')->route($name, $parameters, $absolute);
    }
}

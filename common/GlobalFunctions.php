<?php

if (!function_exists('env')) {
    function env($key, $default = null, $throwException = true)
    {
        $value = getenv($key);

        if ($value === false) {
            if (!$throwException || !is_null($default)) {
                return $default;
            }
            throw new Exception("Unable to find necessary env variable: $key");
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
            case 'on':
                return true;
            case 'false':
            case '(false)':
            case 'off':
                return false;
            case 'empty':
            case '(empty)':
                return '';
        }

        if (substr($value, 1) === '"' && substr($value, -1) === '"') {
            return substr($value, 1, -1);
        }

        return $value;
    }
}
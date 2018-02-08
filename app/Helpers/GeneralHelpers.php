<?php
if (! function_exists('debug')) {
    function debug($data = null, $exit = false)
    {
        echo '<pre>'; print_r($data); echo '</pre>';
        if ($exit) {
            exit();
        }
    }
}

if (! function_exists('check_dir')) {
    function check_dir($pathname)
    {
        if (!is_dir($pathname)) {
            mkdir($pathname, 0777, true);
        }
        return $pathname;
    }
}

if (! function_exists('number_random')) {
    function number_random($length)
    {
        if (is_int($length)) {
            $min = null;
            $max = null;
            for ($i=0; $i < $length; $i++) { 
                $min .= '0';
                $max .= '9';
            }
            return str_pad(rand($min, $max), $length, rand(0,9), STR_PAD_BOTH);
        }
    }
}
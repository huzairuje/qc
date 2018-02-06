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
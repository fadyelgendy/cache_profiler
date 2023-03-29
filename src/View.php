<?php

namespace Fadyandrawes\CacheProfiler;

abstract class View
{
    public function render(array $vars = [])
    {
        extract($vars);

        ob_start();

        include(dirname(__DIR__) . "/src/Views/info.php");

        $output = ob_get_clean();

        return $output;
    }
}

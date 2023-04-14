<?php

function env(string $key, string $default = null): ?string
{
    $key = strtoupper($key);

    $stream = file_get_contents(__DIR__ . "/.env");

    $env = [];

    foreach (explode("\n", $stream) as $line) {
        $line = trim($line);

        $line_exploded = explode("=", $line);

        $env[$line_exploded[0]] = $line_exploded[1];
    }

    return array_key_exists($key, $env) ? $env[$key] : $default;
}

function formatTime(int $time): string
{
    return gmdate("H:i:s", $time);
}

function formatKeys(string $key): string
{
    return ucwords(str_ireplace('_', ' ', $key));
}

function inc(string $file_path, array $attrs): void
{
    extract($attrs);
    include __DIR__ . "/src/Views/" . $file_path . ".php";
}

function dd($var)
{
    var_dump($var);
    die();
}

<?php
function load_env() {
    if (!file_exists(__DIR__ . '/.env')) return;
    foreach (file(__DIR__ . '/.env') as $line) {
        if (trim($line) === '' || str_starts_with(trim($line), '#')) continue;
        [$key, $val] = explode('=', trim($line), 2);
        putenv(trim($key) . '=' . trim($val));
    }
}

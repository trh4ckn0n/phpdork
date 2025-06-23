<?php
function load_env() {
    if (!file_exists(__DIR__ . '/.env')) return;
    foreach (file(__DIR__ . '/.env') as $line) {
        $line = trim($line);
        if ($line === '' || strpos($line, '#') === 0) continue;
        [$key, $val] = explode('=', $line, 2);
        putenv(trim($key) . '=' . trim($val));
    }
}

<?php

// Forward static assets directly
if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js|ico|svg)$/', @_SERVER["REQUEST_URI"])) {
    return false;
}

require __DIR__ . '/../public/index.php';
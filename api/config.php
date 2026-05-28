<?php
// Configuration for asset paths
define('ASSET_BASE', '/');

// Get the current environment
$is_vercel = isset($_SERVER['VERCEL']) || !empty($_SERVER['VERCEL_ENV']);
$is_local = $_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === 'localhost:8000';

// Set paths based on environment
if ($is_local) {
    define('CSS_PATH', '/css/');
    define('IMG_PATH', '/img/');
    define('JS_PATH', '/js/');
} else {
    define('CSS_PATH', '/css/');
    define('IMG_PATH', '/img/');
    define('JS_PATH', '/js/');
}
?>

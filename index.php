<?php
session_start();

use App\Router;

/** Autoload the vendor**/
require_once __DIR__ . '/vendor/autoload.php';


/** Load from environment variables.**/
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS']);
$dotenv->load();


/** Get the base url scheme.**/
function isSecure()
{
    if (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
        return true;
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https') {
        return true;
    } elseif (!empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
        return true;
    } elseif (isset($_SERVER['SERVER_PORT']) && intval($_SERVER['SERVER_PORT']) === 443) {
        return true;
    }
    return false;
}
$scheme = isSecure() ? 'https' : 'http';


/** define constant values.**/
define('ROOT', __DIR__);
define('VIEWS', __DIR__ . '/views');
define('ASSET_DIR', __DIR__ . '/assets');
define('BASE_DIR', isset($_ENV['BASE_DIR']) ? $_ENV['BASE_DIR'] : '');
define('URL', $scheme . '://' . $_SERVER['HTTP_HOST'] . '/' . BASE_DIR);
define('ASSET_URL', URL . '/assets');
require_once __DIR__ . '/app/Config/Router.php';

/** Start the routing.**/
Router::setDefaultNamespace('\Demo\Controllers');
Router::start();

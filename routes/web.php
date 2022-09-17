<?php

/**
 * This file contains all the routes for the project
 */

use App\Router;
use App\Controllers\HomeController;


Router::get('/',  function () {
    return "home page route";
})->setName('home');

Router::get('load', [HomeController::class, 'index']);

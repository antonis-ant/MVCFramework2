<?php
require_once __DIR__ . '/../vendor/autoload.php';

use app\core\Application;
use app\controllers\SiteController;

// Init application
$app = new Application(dirname(__DIR__));
$siteController = new SiteController();

// Set "GET" routes
$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);

// Set "POST" routes
$app->router->post('/contact', [SiteController::class, 'handleContact']);

// Run application
$app->run();
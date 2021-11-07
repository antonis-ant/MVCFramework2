<?php

use antonyanant\phpmvc\Application;

require_once __DIR__ . '/vendor/autoload.php';

// Init dotenv package & load .env parameters
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Gather configuration data from .env file.
$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

// Init application
$app = new Application(__DIR__, $config);

// Apply migrations
$app->db->applyMigrations();

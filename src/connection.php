<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(dirname(__DIR__) . '/.env');

$hostname = $_ENV['DB_HOST'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$database = $_ENV['DB_NAME'];
$dsn = "mysql:host=$hostname;dbname=$database";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
];

try {
    $conn = new PDO($dsn, $username, $password, $options);
} catch (\PDOException $e) {
    error_log("PDOException: {$e->getCode()} {$e->getMessage()}", 3, dirname(__DIR__) . '/log/error.log');
    exit((int) $e->getCode());
}

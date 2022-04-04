<?php

require "src/connection.php";

if (count($argv) < 3 or !isset($argv[1]) or !isset($argv[2])) {
    echo "Usage: php {$argv[0]} <username> <password>" . PHP_EOL;
    exit;
}

$username = htmlspecialchars(strip_tags($argv[1]), ENT_QUOTES | ENT_HTML5 | ENT_DISALLOWED);
$password = htmlspecialchars(strip_tags($argv[1]), ENT_QUOTES | ENT_HTML5 | ENT_DISALLOWED);

if (strlen($username) < 4) {
    echo "Username is too short" . PHP_EOL;
    exit;
}
if (strlen($password) < 8) {
    echo "Password is too short" . PHP_EOL;
    exit;
}

try {
    $stmt = $conn->prepare("CREATE TABLE IF NOT EXISTS users (
        id INT(11) NOT NULL AUTO_INCREMENT,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
    )");
    $stmt->execute();
} catch (PDOException $e) {
    error_log("PDOException: {$e->getCode()} {$e->getMessage()}", 3, 'log/error.log');
    exit((int) $e->getCode());
}

try {
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $hassed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bindParam(':password', $hassed_password, PDO::PARAM_STR);
    $stmt->execute();
} catch (PDOException $e) {
    error_log("PDOException: {$e->getCode()} {$e->getMessage()}", 3, 'log/error.log');
    exit((int) $e->getCode());
}
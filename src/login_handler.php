<?php

require "connection.php";

if (
    (isset($_POST['username']) && !empty($_POST['username'])) && 
    (isset($_POST['password']) && !empty($_POST['password']))
) {
    $username = htmlspecialchars(strip_tags($_POST['username']), ENT_QUOTES | ENT_HTML5 | ENT_DISALLOWED);
    $password = htmlspecialchars(strip_tags($_POST['password']), ENT_QUOTES | ENT_HTML5 | ENT_DISALLOWED);
} else {
    header('Location: login.php?error=empty');
    exit;
}

try {
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->debugDumpParams();
    $user = $stmt->fetch();
} catch (PDOException $e) {
    error_log("PDOException: {$e->getCode()} {$e->getMessage()}", 3, $_ENV['LOG_FILE_LOCATION']);
    header('Location: login.php?error=db');
    exit((int) $e->getCode());
}
if ($user !== false && password_verify($password, $user->password)) {
    session_start();
    session_regenerate_id(true);
    $_SESSION['user'] = $user->id;
    header('Location: index.php');
    exit;
} else {
    header('Location: login.php?error=wrong');
    exit;
}

<?php

require_once 'connection.php';
session_start();
if (isset($_SESSION['user'])) {
    try {
        $stmt = $conn->prepare("SELECT username FROM users WHERE id = :id");
        $stmt->bindParam(':id', $_SESSION['user'], PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch();
    } catch (PDOException $e) {
        error_log("PDOException: {$e->getCode()} {$e->getMessage()}", 3, $_ENV['LOG_FILE_LOCATION']);
        header('Location: login.php?error=db');
        exit((int) $e->getCode());
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vrolik</title>
</head>
<body>
    <?php if (isset($_SESSION['user'])) { ?>
        <h1>Hallo <?= $user->username ?></h1>
    <?php } else { ?>
        <h1>Hallo Gast</h1>
    <?php } ?>
    <h1>Welkom op Vrolik</h1>
    <a href="login.php">Login</a>
</body>
</html>
<?php

if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'empty':
            $error = 'Gelieve alle velden in te vullen.';
            break;

        case 'wrong':
            $error = 'Gebruikersnaam en/of wachtwoord is onjuist.';
            break;

        case 'db':
            $error = 'Er is een fout opgetreden bij het inloggen.';
            break;
        
        default:
            $error = 'Onbekende fout.';
            break;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error)) { ?>
        <p><?= $error ?></p>
    <?php } ?>
    <form action="login_handler.php" method="post">
        <label for="username">Gebruikersnaam</label>
        <input type="text" name="username" id="username" required>
        <label for="password">Wachtwoord</label>
        <input type="password" name="password" id="password" required>
        <input type="submit" value="Login">
    </form>
</body>
</html>
</body>
</html>
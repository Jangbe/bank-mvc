<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
    <title>Login</title>
</head>
<body>
    <h1>Login User</h1>
    <?php getFlash('pesan', 'cej') ?>
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username"><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password"><br>
        <button type="submit">Login</button>
    </form>
    <a href="<?= BASE_URL ?>auth/register">Register</a>
</body>
</html>
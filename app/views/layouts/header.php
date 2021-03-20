<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank MVC</title>
</head>
<body>
    <!-- Navigasi -->
    <ul>
    <?php
        switch($_SESSION['user']['level']){
            case 'admin':
                include __DIR__.'/admin-nav.php';
                break;
            case 'operator':
                include __DIR__.'/operator-nav.php';
                break;
            default:
                include __DIR__.'/nasabah-nav.php';
                break;
        }

    ?>
    <li><a href="<?= url('auth/logout') ?>">Logout</a></li>
    </ul>
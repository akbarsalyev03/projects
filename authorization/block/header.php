<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Website</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <header class="container">
        <span class="logo">logo</span>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About us</a></li>
                <li><a href="contacts.php">contacts</a></li>
                <li><a href="#">News</a></li>
                <?php if (
                    isset($_SESSION["user"]) &&
                    $_SESSION["user"] === true
                ) {
                    echo '<li class="btn"><a href="profile.php">Profile</a></li>';
                } else {
                    echo '<li class="btn"><a href="login.php">login</a></li>';
                } ?>
            </ul>
        </nav>
    </header>

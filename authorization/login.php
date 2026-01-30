<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<?php
include __DIR__ . "/block/header.php";
include __DIR__ . "/func/MYSQL.php";
?>

<body>
    <div class="feedback">
        <div class="container">
            <h2>Login</h2>
            <p>Lorem Ipsum is simply dummy text of the printing .</p>

            <form method="post"><!--email or login, password-->
                <label>Email Address or Login</label>
                <input type="text" class="one-line" name="login">
                <label>Password</label>
                <input type="password" class="one-line" name= 'pass'>
                <input name = "button" type="submit">
            <p>if you don't have a account <a href = 'reg.php' >create account</a></p>
        </form>
            <?php if ($_SERVER["REQUEST_METHOD"] === "POST") {
                function timestop(): bool
                {
                    if (!isset($_SESSION["count"])) {
                        $_SESSION["count"] = 0;
                    }
                    if (!isset($_SESSION["login_block"])) {
                        $_SESSION["login_block"] = 0;
                    }
                    if (time() < $_SESSION["login_block"]) {
                        $_SESSION["count"] = 0;
                        echo "<p>too many attempts, please wait minute</p>";
                        return false;
                    }
                    if ($_SESSION["count"] < 3) {
                        $_SESSION["count"]++;
                        return true;
                    } else {
                        $_SESSION["login_block"] = time() + 60;
                        echo "<p>too many attempts, please wait minute</p>";
                        return false;
                    }
                }

                if (timestop()) {
                    $login = trim(
                        htmlspecialchars(
                            $_POST["login"] ?? "",
                            ENT_QUOTES,
                            "utf-8",
                        ),
                    );
                    $pass = trim(
                        htmlspecialchars(
                            $_POST["pass"] ?? " ",
                            ENT_QUOTES,
                            "UTF-8",
                        ),
                    );
                    $user = read($login, $pass);

                    if ($user === false) {
                        echo "<p>Login or password incorrect</p>";
                    } else {
                        unset(
                            $_SESSION["count"],
                            $_SESSION["login_block_until"],
                        );
                        header("Location: index.php");
                        exit();
                    }
                }
            } ?>
        </div>
    </div>

<?php include __DIR__ . "/block/footer.php"; ?>
</body>
</html>

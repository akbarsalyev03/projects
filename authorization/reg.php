<!DOCTYPE html>
<html lang="en">
<?php
include __DIR__ . "/block/header.php";
include __DIR__ . "/func/MYSQL.php";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <div class="feedback">
        <div class="container">
            <h2>Registration</h2>
            <p>Lorem Ipsum is simply dummy text of the printing .</p>

            <form method="POST" >
                <div class="inline">
                    <div>
                        <label>Login</label>
                        <input type="text"  name="login" value=<?= $_POST[
                            "login"
                        ] ?? "" ?>>
                    </div>
                    <div>
                        <label>Name</label>
                        <input type="text" name="name" value=<?= $_POST[
                            "name"
                        ] ?? "" ?> >
                    </div>
                </div>
                <label>Email</label>
                <input type="email" class="one-line" name="email" value=<?= $_POST[
                    "email"
                ] ?? "" ?>>

                <label>password</label>
                <input type="password" class="one-line" name="password">
                <input type="submit" name='button' value="Register">
            </form>
             <p>You have an account? <a href="login.php">Register</a></p>
            <?php
            $login = trim(
                htmlspecialchars($_POST["login"] ?? "", ENT_QUOTES, "UTF-8"),
            );
            $name = trim(
                htmlspecialchars($_POST["name"] ?? "", ENT_QUOTES, "UTF-8"),
            );
            $email = trim(
                htmlspecialchars($_POST["email"] ?? "", ENT_QUOTES, "UTF-8"),
            );
            $pass = trim(
                htmlspecialchars(
                    $_POST["password"] ?? " ",
                    ENT_QUOTES,
                    "UTF-8",
                ),
            );

            function login()
            {
                global $login;
                if (strlen($login) < 3 || strlen($login) > 50) {
                    $_SESSION["logint"] = true;
                } else {
                    $_SESSION["logint"] = false;
                    $_SESSION["userlogin"] = $login;
                }
            }

            function name()
            {
                global $name;
                if (strlen($name) < 3 || strlen($name) > 50) {
                    $_SESSION["namet"] = true;
                } else {
                    $_SESSION["username"] = $name;
                    $_SESSION["namet"] = false;
                }
            }

            function email()
            {
                global $email;
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION["emailt"] = true;
                } else {
                    $_SESSION["emailt"] = false;
                    $_SESSION["useremail"] = $email;
                }
            }

            function pass()
            {
                global $pass;
                if (
                    !preg_match(
                        '/^(?=.*\d)[A-Za-z\d!@#$%^&*()_+\-=\[\]{};:"\\|,.<>\/?]{8,50}$/',
                        $pass,
                    )
                ) {
                    $_SESSION["passt"] = true;
                } else {
                    $_SESSION["passt"] = false;
                    $_SESSION["userpass"] = $pass;
                }
            }

            if (isset($_POST["button"])) {
                login();
                name();
                email();
                pass();

                if ($_SESSION["logint"]) {
                    echo '<p class="msg">Login must be from 3 to 50 characters</p>';
                }
                if ($_SESSION["namet"]) {
                    echo '<p class="msg">Name must be from 3 to 50 characters</p>';
                }
                if ($_SESSION["emailt"]) {
                    echo '<p class="msg">Email is incorrect</p>';
                }
                if ($_SESSION["passt"]) {
                    echo '<p class="msg">Password must be from 8 to 50 characters, contain at least one uppercase letter and one digit</p>';
                }
                if (
                    !$_SESSION["logint"] &&
                    !$_SESSION["namet"] &&
                    !$_SESSION["emailt"] &&
                    !$_SESSION["passt"]
                ) {
                    $reg = insert($login, $name, $email, $pass);
                    if ($reg == 0.1) {
                        echo "<p>There is another person with this login</p>";
                    } elseif ($reg == 0.2) {
                        echo "<p>There is another person with this email</p>";
                    } else {
                        $_SESSION["userid"] = $reg;
                        header("Location: index.php");
                        exit();
                    }
                }
            }
            ?>
        </div>

    </div>
<?php include __DIR__ . "/block/footer.php"; ?>
</body>
</html>

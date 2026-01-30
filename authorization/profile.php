<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Website</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
<?php
include __DIR__ . "/block/header.php";
include __DIR__ . "/func/MYSQL.php";
?>
    <div class="feedback">
        <div class="container">
            <h2>Say hello</h2>
            <p>Lorem Ipsum is simply dummy text of the printing .</p>
            <form method = "post">
                <div class="inline">
                    <div>
                        <label>Name</label>
                        <input type="text" name="name" value="<?= $_SESSION[
                            "username"
                        ] ?? "" ?>">
                    </div>
                    <div>
                        <label>login</label>
                        <input type="text" name="login" value= "<?= $_SESSION[
                            "userlogin"
                        ] ?? "" ?>">
                    </div>
                </div>
                <label>Email Address</label>
                <input type="email" class="one-line" name="email" value= "<?= $_SESSION[
                    "useremail"
                ] ?? "" ?>" >
                <label>password</label>
                <input type="password" class="one-line" name="pass"  >

                <button type="submit" name="edit_btn">edit</button>
                <button type="submit" name="exit_btn">exit from account</button>
                <button type="submit" name="delet_btn">delet account</button>
                <?php
                $pass = trim(
                    htmlspecialchars(
                        $_POST["pass"] ?? " ",
                        ENT_QUOTES,
                        "UTF-8",
                    ),
                );

                if (
                    isset($_SESSION["userpass"]) &&
                    password_verify($pass, $_SESSION["userpass"])
                ) {
                    if (isset($_POST["exit_btn"])) {
                        session_unset();
                        header("Location: login.php");
                    }

                    if (isset($_POST["delet_btn"])) {
                        delete();
                        session_unset();
                        header("Location: login.php");
                    }

                    if (isset($_POST["edit_btn"])) {
                        $login = trim(
                            htmlspecialchars(
                                $_POST["login"] ?? " ",
                                ENT_QUOTES,
                                "UTF-8",
                            ),
                        );
                        $email = trim(
                            htmlspecialchars(
                                $_POST["email"] ?? " ",
                                ENT_QUOTES,
                                "UTF-8",
                            ),
                        );
                        $name = trim(
                            htmlspecialchars(
                                $_POST["name"] ?? " ",
                                ENT_QUOTES,
                                "UTF-8",
                            ),
                        );
                        function login()
                        {
                            global $login;
                            return strlen($login) >= 3 || strlen($login) <= 50;
                        }
                        function name()
                        {
                            global $name;
                            return strlen($name) >= 3 || strlen($name) <= 50;
                        }
                        function email()
                        {
                            global $email;
                            return filter_var($email, FILTER_VALIDATE_EMAIL);
                        }
                        if (login() && name() && email()) {
                            edit($login, $name, $email);
                            $_SESSION["userlogin"] = $login;
                            $_SESSION["useremail"] = $email;
                            $_SESSION["username"] = $name;
                            header("Location: profile.php");
                        }
                    }
                }
                ?>
            </form>
        </div>
    </div>
<?php include __DIR__ . "/block/footer.php"; ?>
</body>
</html>

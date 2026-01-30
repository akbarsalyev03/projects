<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

$servername = "";
$serverlogin = "";
$serverpass = "";
$dbname = "";

$mysql = new mysqli($servername, $serverlogin, $serverpass);
if ($mysql->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
$mysql->query($sql);
$mysql->select_db($dbname);

$sql = "CREATE TABLE IF NOT EXISTS `user` (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    UNIQUE KEY (`login`),
    UNIQUE KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
$mysql->query($sql);

function read($login_or_email, $pass)
{
    global $mysql;

    $sql = "SELECT * FROM `user` WHERE login = ? OR email = ? LIMIT 1";
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param("ss", $login_or_email, $login_or_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $res = $result->fetch_assoc();

    if ($res && password_verify($pass, $res["password"])) {
        $_SESSION["user"] = true;
        $_SESSION["userid"] = $res["id"];
        $_SESSION["userlogin"] = $res["login"];
        $_SESSION["username"] = $res["name"];
        $_SESSION["useremail"] = $res["email"];
        $_SESSION["userpass"] = $res["password"];
        return true;
    }

    return false;
}

function insert($login, $name, $email, $password)
{
    global $mysql;

    $hashed_password = password_hash(trim($password), PASSWORD_DEFAULT);
    $sql_insert =
        "INSERT INTO user (login, name, email, password) VALUES (?, ?, ?, ?)";
    $stmt_insert = $mysql->prepare($sql_insert);
    if (!$stmt_insert) {
        die("Insert prepare failed: " . $mysql->error);
    }

    $stmt_insert->bind_param("ssss", $login, $name, $email, $hashed_password);
    $stmt_insert->execute();
    $stmt_insert->close();

    $sql_select = "SELECT id FROM user WHERE login = ? AND email = ? LIMIT 1";
    $stmt_select = $mysql->prepare($sql_select);
    if (!$stmt_select) {
        die("Select prepare failed: " . $mysql->error);
    }

    $stmt_select->bind_param("ss", $login, $email);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    $res = $result->fetch_assoc();
    $stmt_select->close();

    $_SESSION["user"] = true;
    $_SESSION["userlogin"] = $login;
    $_SESSION["username"] = $name;
    $_SESSION["useremail"] = $email;
    $_SESSION["userpass"] = $hashed_password;
    return $res;
}

function delete()
{
    global $mysql;

    $sql = "DELETE FROM `user` WHERE  login = ? AND email = ?";
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param("ss", $_SESSION["userlogin"], $_SESSION["useremail"]);
    $stmt->execute();
}

function edit($login, $name, $email)
{
    global $mysql;

    $sql =
        "UPDATE `user` SET login = ?, name = ?, email = ? WHERE login = ? AND email = ?";
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param(
        "sssss",
        $login,
        $name,
        $email,
        $_SESSION["userlogin"],
        $_SESSION["useremail"],
    );

    if ($stmt->execute()) {
        $_SESSION["userlogin"] = $login;
        $_SESSION["useremail"] = $email;
        $_SESSION["username"] = $name;
        return true;
    }
    return false;
}

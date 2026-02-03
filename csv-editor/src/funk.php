<?php
session_start();

function redir(string $url): void
{
    header("Location: $url");
}

foreach (range(6, 12) as $i) {
    if (isset($_SESSION["error_$i"])) {
        unset($_SESSION["error_$i"]);
    }
}

if (!isset($_POST["matrix"])) {
    $_SESSION["error_6"] = "CSV fayl bo'sh";
    redir("view.php");
}

$matrix = $_POST["matrix"];
if (isset($_POST["save_btn"])) {
    if (!isset($_POST["name"]) || trim($_POST["name"]) === "") {
        $_SESSION["error_7"] = "CSV nomi kiritilmadi";
        redir("view.php");
    }

    $name = basename(trim($_POST["name"]));
    if (!str_ends_with($name, ".csv")) {
        $name .= ".csv";
    }

    $_SESSION["csv_name"] = $name;

    $uploadDir = __DIR__ . "/uploads";

    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0755, true)) {
            $_SESSION["error_8"] = "Uploads papkasi yaratilmadi";
            redir("view.php");
        }
    }

    if (!is_writable($uploadDir)) {
        $_SESSION["error_9"] = "Uploads papkasi yozish uchun ruxsatsiz";
        redir("view.php");
    }

    $filePath = $uploadDir . "/" . $name;
    $handle = fopen($filePath, "w");

    if ($handle === false) {
        $_SESSION["error_10"] = "CSV fayl yaratilmadi";
        redir("view.php");
    }

    foreach ($matrix as $row) {
        fputcsv($handle, $row);
    }

    fclose($handle);

    if (!file_exists($filePath)) {
        $_SESSION["error_11"] = "CSV fayl topilmadi";
        redir("view.php");
    }

    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename=\"$name\"");
    header("Content-Length: " . filesize($filePath));
    header("Pragma: no-cache");
    header("Expires: 0");

    readfile($filePath);
    exit();
}

if (isset($_POST["column_btn"])) {
    $_SESSION["csv_matrix"] = add_column();
    redir("view.php");
}

if (isset($_POST["row_btn"])) {
    $_SESSION["csv_matrix"] = add_row();
    redir("view.php");
}

if (isset($_POST["row_clear"])) {
    if (isset($_POST["number"]) && is_numeric($_POST["number"])) {
        $number = $_POST["number"] - 1;
        $_SESSION["csv_matrix"] = clear_row($matrix, $number);
        redir("view.php");
    } else {
        $_SESSION["error_12"] =
            "Ustin yoki Qatorni olib tashlash uchun son kiriting";
        redir("view.php");
    }
}

if (isset($_POST["column_clear"])) {
    if (isset($_POST["number"]) && is_numeric($_POST["number"])) {
        $number = $_POST["number"] - 1;
        $_SESSION["csv_matrix"] = clear_column($matrix, $number);
        redir("view.php");
    } else {
        $_SESSION["error_12"] =
            "Ustin yoki Qatorni olib tashlash uchun son kiriting";
        redir("view.php");
    }
}

function add_column()
{
    global $matrix;

    $row = count($matrix);
    $column = count($matrix[0]) + 1;

    for ($i = 0; $i < $row; $i++) {
        $matrix[$i][$column] = "";
    }

    return array_values($matrix);
}

function add_row()
{
    global $matrix;

    $row = count($matrix) + 1;
    $column = count($matrix[0]);

    for ($i = 0; $i < $column; $i++) {
        $matrix[$row][$i] = "";
    }

    return array_values($matrix);
}

function clear_row(array $matrix, int $number): array
{
    if (!isset($matrix[$number])) {
        return $matrix;
    }

    unset($matrix[$number]);
    return array_values($matrix);
}

function clear_column(array $matrix, int $number): array
{
    $col = $number;

    foreach ($matrix as &$row) {
        if (isset($row[$col])) {
            unset($row[$col]);
            $row = array_values($row);
        }
    }

    unset($matrix[$number]);
    return array_values($matrix);
}

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

foreach (range(1, 5) as $i) {
    unset($_SESSION["error_$i"]);
}

if (!isset($_FILES["file"])) {
    $_SESSION["error_1"] = "Fayl yuklanmadi";
}

$file = $_FILES["file"];

if ($file["error"] !== UPLOAD_ERR_OK) {
    $_SESSION["error_2"] = "Yuklashda xatolik bor ";
}

$maxSize = 5 * 1024 * 1024;
if ($file["size"] > $maxSize) {
    $_SESSION["error_3"] = "Fayl juda katta ";
}

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $file["tmp_name"]);
finfo_close($finfo);

$allowedTypes = ["text/plain", "text/csv"];
if (!in_array($mime, $allowedTypes)) {
    $_SESSION["error_4"] = "Ruxsat etilmagan fayl turi ";
}

$matrix = [];

if (($handle = fopen($file["tmp_name"], "r")) !== false) {
    while (($row = fgetcsv($handle, 0, ",")) !== false) {
        $matrix[] = $row;
    }
    fclose($handle);
}

if (empty($matrix)) {
    $_SESSION["error_5"] = "CSV fayl bo‘sh ";
}
$_SESSION["csv_name"] = $file["name"];
$_SESSION["csv_matrix"] = $matrix;
if (
    isset($_SESSION["error_1"]) ||
    isset($_SESSION["error_2"]) ||
    isset($_SESSION["error_3"]) ||
    isset($_SESSION["error_4"]) ||
    isset($_SESSION["error_5"])
) {
    header("Location: index.php");
} else {
    header("Location: view.php");
}
exit();

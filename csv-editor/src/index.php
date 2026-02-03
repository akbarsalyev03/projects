<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>csv-editor</title>
    </head>
    <body>
        <h1>Fayl yuklash</h1>
        <form action="check.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" required />
            <input type="submit" value="Yuklash" />
        </form>
        <br>
             <?php for ($i = 1; $i <= 5; $i++) {
                 if (isset($_SESSION["error_$i"])) {
                     echo "<p>" . $_SESSION["error_$i"] . "</p>";
                 }
             } ?>
    </body>
</html>

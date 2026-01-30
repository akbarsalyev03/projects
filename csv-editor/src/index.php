<?php session_start(); ?>
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
             <?php
             if (isset($_SESSION["error_1"])) {
                 echo "<p>" . $_SESSION["error_1"] . "</p>";
             }
             if (isset($_SESSION["error_2"])) {
                 echo "<p>" . $_SESSION["error_2"] . "</p>";
             }
             if (isset($_SESSION["error_3"])) {
                 echo "<p>" . $_SESSION["error_3"] . "</p>";
             }
             if (isset($_SESSION["error_4"])) {
                 echo "<p>" . $_SESSION["error_4"] . "</p>";
             }
             if (isset($_SESSION["error_5"])) {
                 echo "<p>" . $_SESSION["error_5"] . "</p>";
             }
             ?>
    </body>
</html>

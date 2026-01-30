
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>csv-editor</title>
    </head>
<body>
    <?php
    include "header.php";
    session_start();

    if (!isset($_SESSION["csv_matrix"])) {
        die("fayl topilmadi");
    }

    $matrix = $_SESSION["csv_matrix"];
    ?>
    <table border="1" cellpadding="5">
    <?php
        foreach($matrix as $row){
        echo "<tr>";
            foreach ($row as $cell){
                echo "<td><<input type="text" name="name" value="value">" .  . "</td>";
            }
        echo "</tr>";
        }
    ?>
        <tr>
            <?php foreach ($row as $cell);
            ?>
                <td><?= htmlspecialchars($cell) ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
    </table>
    </body>
</html>

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
        <link rel="stylesheet" href="styles.css">
    </head>
<body>
    <?php
    include "index.php";

    if (!isset($_SESSION["csv_matrix"])) {
        die("fayl topilmadi");
    }

    $matrix = $_SESSION["csv_matrix"];
    ?>

    <form method="post" action="funk.php">
        <br>
        <button type="submit" name="column_btn">Ustun qo'shish</button>
        <button type="submit" name="row_btn">Qator qo'shish</button>
        <br>
        <br>
        <input type="text" name="number" placeholder="tanlangan qator/ustun soni">
        <button type="submit" name="column_clear">Ustun</button>
        <button type="submit" name="row_clear">Qator</button>
        <br>
        <br>
        <table border="4" cellpadding="4" style="border-collapse: collapse; text-align:center;">
            <tr>
                <th>№</th>
                <?php for ($col = 0; $col < count($matrix[0]); $col++): ?>
                    <th><?= $col + 1 ?></th>
                <?php endfor; ?>
            </tr>
            <?php foreach ($matrix as $rowIndex => $row): ?>
                <tr>
                    <th><?= $rowIndex + 1 ?></th>
                    <?php foreach ($row as $colIndex => $cell): ?>
                        <td>
                            <input
                                type="text"
                                name="matrix[<?= $rowIndex ?>][<?= $colIndex ?>]"
                                value="<?= htmlspecialchars($cell) ?>"
                                style="width:80px; text-align:right; border:2px solid black;"
                            >
                        </td>
                    <?php endforeach; ?>

                </tr>
            <?php endforeach; ?>

        </table>

        <br>
        <input type="text" name="name" value="<?= $_SESSION["csv_name"] ?>">
        <button type="submit" name="save_btn">Saqlash</button>
    </form>

    </body>
    </html>

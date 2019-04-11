<?php
/**
 * Created by PhpStorm.
 * User: Shokhaa
 * Date: 4/11/19
 * Time: 10:24 PM
 */

session_start();

if (isset($_SESSION['userEmail'])) {


    include_once '../config/config.php';
    $database = new DBConnect();
    $db = $database->openConnection();

    $sql = "select email from users where email = '{$_SESSION['userEmail']}'";
    $user = $db->query($sql);
    $result = $user->fetchAll(PDO::FETCH_COLUMN);

    $database->closeConnection();
    if ($_SESSION['userEmail'] == $result[0]) {

        $db = $database->openConnection();


        $sql = "select * from products";
        $products = $db->query($sql);
        $products = $products->fetchAll(PDO::FETCH_ASSOC);
        $database->closeConnection();
        ?>
        <!DOCTYPE html>
        <html lang="ru">
        <head>
            <style>
                table, th, td {
                    border: 1px solid black;
                }
            </style>
            <title>tovarlar</title>
            <link rel="stylesheet" type="text/css" href="/assets/style.css">
        </head>
        <body>

        <div class="demo-content">

            <a href="create.php">
                <button type="button"
                        name="submit" class="btn signup">Qo`shish
                </button>
            </a>
            <table>
                <th>№</th>
                <th>Product name</th>
                <th>Description</th>
                <?
                $i = 0;
                foreach ($products as $item) {
                    $i++;

                    echo "<tr>";
                    echo "<td>{$i}</td>";
                    echo "<td>{$item['title']}</td>";
                    echo "<td>{$item['description']}</td>";
                    echo "</tr>";

                }
                ?>

            </table>




            <div></div>
        </div>
        </body>
        </html>
        <?
    }
}else{
    echo "ro`yxatdan o`tmagansiz!";
    header("refresh: 1; url=/index.php");

}
    ?>


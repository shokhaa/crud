<?php
/**
 * Created by PhpStorm.
 * User: Shokhaa
 * Date: 4/11/19
 * Time: 10:48 PM
 */

include_once '../config/config.php';
$database = new DBConnect();
$db = $database->openConnection();

if (isset($_SESSION['userEmail'])) {



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
        <?
        if (isset($_POST['submit']) and !empty($_POST['productDescription']) and !empty($_POST['productName'])) {

        $productName = htmlspecialchars(trim($_POST['productName']));
        $productDescription = htmlspecialchars(trim($_POST['productDescription']));
        $sql = "insert into products (title, description) values('$productName','$productDescription')";

        $asd = $db->exec($sql);
        $database->closeConnection();

        }
        ?>
        <link rel="stylesheet" type="text/css" href="/assets/style.css">

        <div class="demo-content">
            <form action="" method="POST"
                  onsubmit="return addProductValidation()">


                <div class="row">
                    <label>Tavar nomoi</label><span id="productName_err"></span>
                    <div>
                        <input type="text" name="productName" id="productName"
                               class="form-control"
                               placeholder="nom yozing">

                    </div>
                </div>

                <div class="row">
                    <label>Tavar tarifi</label><span id="productDescription_err"></span>
                    <div>
                        <input type="text" name="productDescription" id="productDescription"
                               class="form-control"
                               placeholder="tarif yozing">

                    </div>
                </div>


                <div class="row">
                    <div align="center">
                        <button type="submit" name="submit"
                                class="btn signup">Qo`shish
                        </button>
                    </div>
                </div>

            </form>

        </div>


        </body>
        <head>
            <title>Tavar qo`shish</title>
            <link rel="stylesheet" type="text/css" href="../assets/style.css">
            <script>
                function addProductValidation() {
                    var productName = document.getElementById('productName').value;
                    var productDescription = document.getElementById('productDescription').value;


                    var valid = true;


                    if (productName == "") {
                        valid = false;
                        document.getElementById('productName_err').innerHTML = " majburiy.";
                    }
                    if (productDescription == "") {
                        valid = false;
                        document.getElementById('productDescription_err').innerHTML = " majburiy.";
                    }


                    return valid;
                }
            </script>
        </head>
        </html>
        <?
    }
}
?>
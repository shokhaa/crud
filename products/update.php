<?php
/**
 * Created by PhpStorm.
 * User: Shokhaa
 * Date: 4/12/19
 * Time: 7:32 AM
 */
session_start();

include_once '../config/config.php';


$database = new DBConnect();
$db = $database->openConnection();
if (empty($_SESSION['userEmail'])){
    header("Location: index.php");

}else{
    $sql = "select email from users where email = '{$_SESSION['userEmail']}'";
    $user = $db->query($sql);
    $result = $user->fetchAll(PDO::FETCH_COLUMN);

    $database->closeConnection();
    if ($_SESSION['userEmail'] != $result[0]) {
        header("Location: index.php");

    }
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "select * from products where id = '{$id}'";
    $user = $db->query($sql);
    $result = $user->fetchAll(PDO::FETCH_ASSOC);
    $database->closeConnection();
}

if ($_POST){
//    die('1');
//    print_r($_POST);
    $productName = htmlspecialchars(trim($_POST['productName']));
    $productDescription = htmlspecialchars(trim($_POST['productDescription']));
    $query = "UPDATE products SET title = '$productName', description = '$productDescription' where id= $id;";
    $result = $db->exec($query);
//    $result->execute([$productName, $productDescription]);
    header("Location: index.php?update");


}
    ?>
    <title>Update: <?=$result[0]['title']?></title>

    <link rel="stylesheet" type="text/css" href="/assets/style.css">

    <div class="demo-content">
        <form action="" method="POST"
              onsubmit="return addProductValidation()">


            <div class="row">
                <label>Tavar nomoi</label><span id="productName_err"></span>
                <div>
                    <input type="text" name="productName" value="<?=$result[0]['title']?>" id="productName"
                           class="form-control"
                           placeholder="nom yozing">

                </div>
            </div>

            <div class="row">
                <label>Tavar tarifi</label><span id="productDescription_err"></span>
                <div>
                    <input type="text" name="productDescription"  value="<?=$result[0]['description']?>" id="productDescription"
                           class="form-control"
                           placeholder="tarif yozing">

                </div>
            </div>


            <div class="row">
                <div align="center">
                    <button type="submit" name="submit"
                            class="btn signup">Tasdiqlash
                    </button>
                </div>
            </div>

        </form>

    </div>



<!--    --><?//
//}else
//    echo 2;?>
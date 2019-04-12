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
    $sql = "    DELETE FROM `products` WHERE `id` = $id";
    $query = $db->query($sql);
    if ($query){
        header("Location: index.php?delete");

    }
}
    ?>
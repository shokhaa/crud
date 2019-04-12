<?php
session_start();
//session_destroy();
//die();
/**
 * Created by PhpStorm.
 * User: Shokhaa
 * Date: 4/11/19
 * Time: 9:43 PM
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once 'config/config.php';
//print_r($_SESSION);
//die();
if (isset($_SESSION['userEmail'])) {
    $database = new DBConnect();
    $db = $database->openConnection();

    $sql = "select email from users where email = '{$_SESSION['userEmail']}'";
    $user = $db->query($sql);
    $result = $user->fetchAll(PDO::FETCH_COLUMN);
//    echo $result[0];
//    die();
    $database->closeConnection();
    if ($_SESSION['userEmail'] == $result[0]) {
        header("Location: products/index.php");

    }
}
if (isset($_POST["submit"])) {

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $database = new DBConnect();

    $db = $database->openConnection();

    $sql = "select * from users where email = '$email' and password= '$password'";
    $user = $db->query($sql);
    $result = $user->fetchAll(PDO::FETCH_ASSOC);


    $database->closeConnection();
    if (!empty($result)) {
        $_SESSION['userEmail'] = $email;
        header("Location: products/index.php");
    }else{
        $response = array(
            "type" => "error",
            "message" => "Login yoki parol noto`g`ri"
        );
    }

//    header('location: dashboard.php');
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Kirish</title>
    <?php
    if (!empty($response)) {
        ?>
        <div id="response" class="<?php echo $response["type"]; ?>"><?php echo $response["message"]; ?></div>
        <?php

    }
    ?>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <script>
        function loginvalidation() {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            var valid = true;

            if (email == "") {
                valid = false;
                document.getElementById('email_error').innerHTML = "required.";
            }

            if (password == "") {
                valid = false;
                document.getElementById('password_error').innerHTML = "required.";
            }
            return valid;
        }
    </script>
</head>
<body>
<div class="demo-content">
    <h3>Kirish</h3>
    <form action="" method="POST"
          onsubmit="return loginvalidation();">


        <div class="row">
            <label>Email</label> <span id="email_error"></span>
            <div>
                <input type="text" name="email" id="email"
                       class="form-control"
                       placeholder="e-mail">
            </div>
        </div>

        <div class="row">
            <label>Parol</label><span id="password_error"></span>
            <div>
                <input type="Password" name="password" id="password"
                       class="form-control"
                       placeholder="parolizni yozing">

            </div>
        </div>
        <div class="row">
            <div>
                <button type="submit" name="submit"
                        class="btn login">Kirish
                </button>
            </div>
        </div>
        <div class="row">
            <div>
                <a href="signup.php">
                    <button type="button"
                            name="submit" class="btn signup">Ro`yxatdan o`tish
                    </button>
                </a>
            </div>
        </div>
    </form>
</div>
</body>
</html>
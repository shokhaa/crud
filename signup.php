<?php
session_start();
//session_destroy();
/**
 * Created by PhpStorm.
 * User: Shokhaa
 * Date: 4/11/19
 * Time: 8:40 PM
 */
include_once 'config/config.php';

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
        header("Location: product/index.php");

    }
}
if (isset($_POST["submit"])) {

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $database = new DBConnect();

    $db = $database->openConnection();
    $validateQuery = "select  email from users where email='$email'";

    $user = $db->query($validateQuery);
    $result = $user->fetchAll();

//    echo "<pre>";
//    $_SESSION['emailname'] = $result[0]['email'];
//    print_r($result);
//    die();
    if (empty($result)) {
        $sql = "insert into users (email, password) values('$email','$password')";
        $_SESSION['userEmail'] = $email;

        $db->exec($sql);

        $database->closeConnection();
        $response = array(
            "type" => "success",
            "message" => "Ro`yxatdan o`tiz.<br/><a href='login.php'>Now Login</a>."
        );
    } else {
        $response = array(
            "type" => "error",
            "message" => "Bu email ro`yxatdan o`tkan"
        );
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<div class="demo-content">
    <?php
    if (!empty($response)) {
        ?>
c        <?php
        header("refresh: 1; url=products/index.php");
//        header("Location: ");

    }
    ?>
    <form action="" method="POST"
          onsubmit="return signupvalidation()">


        <div class="row">
            <label>E-mail</label><span id="email_error"></span>
            <div>
                <input type="text" name="email" id="email"
                       class="form-control"
                       placeholder="Email yozing">

            </div>
        </div>

        <div class="row">
            <label>Parol</label><span id="password_error"></span>
            <div>
                <input type="Password" name="password" id="password"
                       class="form-control"
                       placeholder="Parol">

            </div>
        </div>

        <div class="row">
            <label>Parolni tasdiqlash</label><span
                id="confirm_password_error"></span>
            <div>
                <input type="password" name="confirm_pasword"
                       id="confirm_pasword" class="form-control"
                       placeholder="parolni qayta yozing">

            </div>
        </div>


        <div class="row">
            <div align="center">
                <button type="submit" name="submit"
                        class="btn signup">Sign Up
                </button>
            </div>
        </div>

        <div class="row">
            <div>
                <a href="login.php">
                    <button type="button" name="submit"
                            class="btn login">Login
                    </button>
                </a>
            </div>
        </div>
    </form>

</div>


</body>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <script>
        function signupvalidation() {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var confirm_pasword = document.getElementById('confirm_pasword').value;
            var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

            var valid = true;


            if (email == "") {
                valid = false;
                document.getElementById('email_error').innerHTML = " majburiy.";
            } else {
                if (!emailRegex.test(email)) {
                    valid = false;
                    document.getElementById('email_error').innerHTML = " nog`ri format.";
                }
            }

            if (password == "") {
                valid = false;
                document.getElementById('password_error').innerHTML = " majburiy.";
            }
            if (confirm_pasword == "") {
                valid = false;
                document.getElementById('confirm_password_error').innerHTML = " majburiy.";
            }

            if (password != confirm_pasword) {
                valid = false;
                document.getElementById('confirm_password_error').innerHTML = " parol bir biriga mos emas";
            }

            return valid;
        }
    </script>
</head>
</html>
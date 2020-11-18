<?php
// sometimes there will be error, if not route from the root path ('/'), so try this :)
require '/xampp/htdocs/PSW-SEM3/Payroll/Library/connection.php';

session_start();

$errors = [];

// LOGIN
if (isset($_POST['login-user'])) {
    $email = $_POST['login-email'];
    $password = $_POST['login-psw'];
    $link_address   = "../../View/Email/resendVerification.php";

    $query = "SELECT * FROM user JOIN group_user ON user.group_id = group_user.id WHERE user.email='$email' LIMIT 1";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

    if (mysqli_num_rows($result) === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            if ($user['verify_token'] == null) {
                $_SESSION['login-response'] = "Please Verify your account first!" .  " Have not receive email yet? <a href='" . $link_address . "'>Send Verification email.</a>";
                $_SESSION['login-res-type'] = "danger";

                header('location: ../../View/login.php');
            } else {
                $_SESSION['email'] = $user['email'];
                $_SESSION['login'] = true;
                $_SESSION['role'] = $user['group_name'];
                $_SESSION['temp_role'] = $user['group_name'];
                header('location: ../../View/index.php?response=Welcome&res-type=success');
                exit();
            }
        } else {
            $errors['login_fail'] = "Wrong Password";
        }
    } else {
        $errors['login_fail'] = "Email doesn't exists";
    }

    if (count($errors) > 0) {
        $_SESSION['login-response'] = $errors['login_fail'];
        $_SESSION['login-res-type'] = "danger";
        header('location: ../../View/login.php');
    }
}

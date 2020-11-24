<?php
// PHPMailer with SMTP
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// sometimes there will be error, if not route from the root path ('/'), so try this :)
require '/xampp/htdocs/PSW-SEM3/Payroll/Library/connection.php';
require_once '/xampp/htdocs/PSW-SEM3/Payroll/vendor/autoload.php';

session_start();

$email = "";
$mail = new PHPMailer(true);
$errors = [];

// LOGIN
if (isset($_POST['login-user'])) {
    $email = $_POST['login-email'];
    $password = $_POST['login-psw'];
    $link_address   = "../View/Email/resendVerification.php";

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

// Reset Password
if (isset($_POST['reset_password'])) {
    $resetToken       = $_POST['reset_token'];
    $email       = $_POST['email'];
    $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT); //encrypt password

    // find user by Email
    $user  = $connection->query("UPDATE user SET reset_token = '$resetToken', password = '$newPassword' WHERE email= '$email' LIMIT 1") or die($connection->error);

    if (!$user) {
        $_SESSION['register-response']  = "Sorry, Failed to reset your account password.";
        $_SESSION['register-res-type'] = "danger";

        header('location: ../../View/login.php');
    }

    $_SESSION['register-response']    = "You've successfully reset your account password !!";
    $_SESSION['register-res-type']   = 'success';
    header("location: ../../View/login.php");
}

// Send Reset Password Email
if (isset($_POST['send_reset_password'])) {
    $email      = $_POST['email'];
    $emailVerifyToken      = bin2hex(random_bytes(50)); // Generate Unique token
    $mail       = new PHPMailer(true);
    $errors     = [];

    $result = $connection->query("SELECT * FROM user WHERE email = '$email' LIMIT 1 ") or die($connection->error);

    // check whether email exist or not in DB
    if (mysqli_num_rows($result) === 1) {
        $user = $result->fetch_assoc();

        $fullname     = $user['fullname'];
        // prepare email needs
        $message = file_get_contents('../../View/Email/emailResetPassword.php');
        $message = str_replace('%fullname%', $fullname, $message);
        $message = str_replace('%link%', "http://localhost/PSW-SEM3/Payroll/View/Auth/resetPassword.php?token=" . $emailVerifyToken . "&email=" . $email, $message);
        $message = str_replace('%year%', date("Y"), $message);

        // send verification email
        $mail->isSMTP();
        $mail->SMTPDebug  = 3;
        $mail->Host       = "smtp.gmail.com";
        $mail->SMTPAuth   = true;
        $mail->Username   = "fred88yt@gmail.com";
        $mail->Password   = "[YOUR-EMAIL-PASSWORD]";
        //If SMTP requires TLS encryption then set it
        $mail->SMTPSecure = "tsl";
        //Set TCP port to connect to
        $mail->Port       = 587;
        $mail->setFrom('fred88yt@gmail.com', 'Chen Frederick from FDTECH');
        $mail->addAddress($email, $fullname); // Add a recipient
        $mail->isHTML(true); // Set email format to HTML

        $mail->Subject    = 'AIA x FDTECH - Reset your password here !!';
        $mail->Body       = $message;
        $mail->AltBody    = 'This is the body in plain text for non-HTML mail clients';


        if (!$mail->send()) {
            $_SESSION['register-response'] = "failed to send email" . $mail->ErrorInfo;
            $_SESSION['register-res-type'] = "danger";

            header('location:../../View/Email/resetPassword.php');
            exit();
        } else {
            $_SESSION['fullname']   = $fullname;
            $_SESSION['email']      = $email;
            $_SESSION['verified']   = false;
            $_SESSION['register-response']    = 'Successfully send reset password email! Please check your inbox.';
            $_SESSION['register-res-type']   = 'success';

            echo "<script>window.location.assign('../../View/login.php')</script>";
            exit();
        }
    } else {
        $errors['verify_fail'] = "Sorry, Your email doesn't exist in our database.";
    }

    if (count($errors) > 0) {
        $_SESSION['register-response']     = $errors['verify_fail'];
        $_SESSION['register-res-type']    = "danger";

        header('location: ../../View/login.php');
    }
}

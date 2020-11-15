<?php
// PHPMailer with SMTP
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Library/connection.php';
require_once    '../vendor/autoload.php';

session_start();

$email = "";
$errors = [];
$mail = new PHPMailer(true);
// whoever register will always registered as employee
$group_id = 1;

// SIGN UP USER
if (isset($_POST['register-user'])) {
    $email = $_POST['register-email'];
    $fullname = $_POST['register-fullname'];
    $created_at = date('Y-m-d H:i:s', time());
    $emailVerifyToken = bin2hex(random_bytes(50)); // generate unique token

    // send-email needs
    $message = file_get_contents('../View/Email/verifyToEmail.php');
    $message = str_replace('%fullname%', $fullname, $message);
    $message = str_replace('%link%', "http://localhost/PSW-SEM3/Payroll/View/Auth/verifyAccount.php?token=" . $emailVerifyToken . "&email=" . $email, $message);
    $message = str_replace('%year%', date("Y"), $message);

    // Check if email already exists
    $query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $errors['register-email'] = "Email already exists";
    }

    if (count($errors) === 0) {
        $password = password_hash($_POST['register-psw'], PASSWORD_DEFAULT); //encrypt password

        $query = "INSERT INTO user SET email=?, fullname=?, password=?, group_id=?, created_at=?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param('sssss', $email, $fullname, $password, $group_id, $created_at);
        $result = $stmt->execute();

        if ($result) {
            $user_id = $stmt->insert_id;
            $stmt->close();

            // send verification email
            $mail->isSMTP();
            $mail->SMTPDebug  = 3;
            $mail->Host       = "smtp.gmail.com";
            $mail->SMTPAuth   = true;
            $mail->Username   = "fred88yt@gmail.com";
            $mail->Password   = "[your_EMAIL_PASSWORD]";
            //If SMTP requires TLS encryption then set it
            $mail->SMTPSecure = "tsl";
            //Set TCP port to connect to
            $mail->Port       = 587;
            $mail->setFrom('fred88yt@gmail.com', 'Chen Frederick from FDTECH');
            $mail->addAddress($email, 'customer'); // Add a recipient
            $mail->isHTML(true); // Set email format to HTML

            $mail->Subject    = 'AIA x FDTECH - Verify your account now';
            $mail->Body       = $message;
            $mail->AltBody    = 'This is the body in plain text for non-HTML mail clients';

            if (!$mail->send()) {
                $_SESSION['response'] = "failed to send email" . $mail->ErrorInfo;
                $_SESSION['res-type'] = "danger";

                header('location:../View/register.php');
                exit();
            } else {
                $_SESSION['email'] = $email;
                $_SESSION['verified'] = false;
                $_SESSION['response'] = 'Account success registered! Please do verify on your registered email.';
                $_SESSION['res-type'] = 'success';
                // header('location: ../View/login.php');
                echo "<script>window.location.assign('../View/login.php')</script>";
                exit();
            }
        } else {
            $_SESSION['error_msg'] = "Database error: Could not register user";
        }
    } else {
        $_SESSION['response'] = $errors['register-email'];
        $_SESSION['res-type'] = "danger";

        header('location: ../view/register.php');
    }
}

// Verify Account
if (isset($_POST['verify_account'])) {
    $token       = $_POST['verify_token'];
    $email       = $_POST['email'];
    $verify_time = date('Y-m-d H:i:s', time());

    // find user by Email
    $user  = $connection->query("UPDATE user SET verify_token = '$token', verified_at = '$verify_time' WHERE email= '$email' LIMIT 1") or die($connection->error);

    if (!$user) {
        $_SESSION['response']  = "Sorry, Failed to verify your account.";
        $_SESSION['res-type'] = "danger";

        header('location: ../View/login.php');
    }

    $_SESSION['response']    = 'Your account have been successfully verified!';
    $_SESSION['res-type']   = 'success';

    // Back to Index
    header("location: ../View/login.php");
}

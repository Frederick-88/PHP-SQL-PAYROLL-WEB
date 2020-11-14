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
    $token = bin2hex(random_bytes(50)); // generate unique token
    $password = password_hash($_POST['register-psw'], PASSWORD_DEFAULT); //encrypt password

    // Check if email already exists
    $query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $errors['register-email'] = "Email already exists";
    }

    if (count($errors) === 0) {
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
            $mail->Password   = "";
            //If SMTP requires TLS encryption then set it
            $mail->SMTPSecure = "tsl";
            //Set TCP port to connect to
            $mail->Port       = 587;
            $mail->setFrom('fred88yt@gmail.com', 'Chen Frederick');
            $mail->addAddress($email, 'customer'); // Add a recipient
            $mail->isHTML(true); // Set email format to HTML

            $mail->Subject    = 'Someone has something to say about ----';
            // $mail->Body    = $message;
            $mail->Body       = "Please Verify your account";
            $mail->AltBody    = 'This is the body in plain text for non-HTML mail clients';

            if (!$mail->send()) {
                $_SESSION['response'] = "failed to send email" . $mail->ErrorInfo;
                $_SESSION['res-type'] = "danger";

                header('location:../../View/auth/register.php');
                exit();
            } else {
                $_SESSION['email'] = $email;
                $_SESSION['verified'] = false;
                $_SESSION['response'] = 'Account success registered!';
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

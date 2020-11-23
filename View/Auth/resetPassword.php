<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Assets/style/css/style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Reset Password</title>
</head>
<style type="text/css" rel="stylesheet" media="all">
    .main-center-container {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
</style>

<body>
    <!-- < ?php include "../../Component/Alert.php" ?> -->
    <?php
    require_once '../../Library/connection.php';
    $token   = $_GET['token'];
    $email   = $_GET['email'];
    ?>
    <div class="container-fluid vh-100">
        <div class="main-center-container">
            <form action="../../Model/Auth/loginController.php" method="POST">
                <div class="card no-border p-4">
                    <div class="card-body">
                        <h5 class="card-title mb-2 text-center font-weight-bold border-bottom">FDTECH X AIA</h5>
                        <h5 class="card-title mb-4">Reset your account password here</h5>
                        <input type="password" name="new_password" class="form-control mb-3" placeholder="New Password" required>
                        <input type="hidden" name="reset_token" value="<?= $token ?>">
                        <input type="hidden" name="email" value="<?= $email ?>">
                        <button class="btn btn-warning btn-block" name="reset_password">Reset Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
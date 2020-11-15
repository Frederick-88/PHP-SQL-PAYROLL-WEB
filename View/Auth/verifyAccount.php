<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Assets/style/css/style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Verify Account</title>
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
            <form action="../../Model/registerController.php" method="POST">
                <div class="card no-border p-4">
                    <div class="card-body">
                        <h5 class="card-title mb-2 text-center font-weight-bold border-bottom">FDTECH X AIA</h5>
                        <h5 class="card-title mb-4">Verify your account here</h5>
                        <input type="hidden" name="verify_token" value="<?= $token ?>">
                        <input type="hidden" name="email" value="<?= $email ?>">
                        <button class="btn btn-warning btn-block" name="verify_account">Verify</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Assets/style/css/style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Resend Verification</title>
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
    <?php require_once "../../Model/Auth/registerController.php" ?>
    <div class="container vh-100">
        <div class="main-center-container">
            <div class="border p-4 border-warning">
                <?php include "../../Component/Alert.php" ?>

                <h4>Want to resent verification email? </h4>
                <p>Input your email below, we will send you an email to verify your account.</p>
                <form action="../../Model/Auth/registerController.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="email">Email Address<span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Please input your email here." required>
                    </div>
                    <div class="form-group mg-t-50">
                        <button class="btn btn-warning btn-block" name="resend_verification" id="resend_verification">Send Verification Email</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
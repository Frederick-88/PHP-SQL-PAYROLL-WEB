<?php include '../Model/registerController.php' ?>
<?php if (isset($_SESSION['login'])) {
    header('location:./index.php');
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
    <title>Register Page</title>
</head>

<body>
    <div class="login__bg d-flex justify-content-center">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-sm-12">
                    <div class="login__modal p-5 bg-warning text-white">
                        <h3 class="font-weight-bold text-center">AIA-REGISTER</h3>
                        <?php include '../Component/Alert.php' ?>
                        <form action="../Model/registerController.php" method="POST">
                            <div class="form-group">
                                <label for="register-email">New Email address</label>
                                <input type="email" name="register-email" class="form-control" id="register-email" placeholder="Enter email">
                                <small id="emailHelp" class="form-text">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label for="register-fullname">Your Fullname</label>
                                <input type="text" name="register-fullname" class="form-control" id="register-fullname" placeholder="Enter fullname">
                            </div>
                            <div class="form-group">
                                <label for="register-psw">New Password</label>
                                <input type="password" name="register-psw" class="form-control" id="register-psw" placeholder="Password">
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <button type="submit" name="register-user" class="btn btn-light w-50 text-warning">Register</button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <a href="login.php">Already have account? Sign in.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php require_once '../Model/Auth/loginController.php'; ?>
<?php if (!isset($_SESSION['login'])) {
    $_SESSION['response'] = "Hey there, please login first =)";
    $_SESSION['res-type'] = "danger";
    header('location: ../View/login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="index.css">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <title>Home Page AIA</title>
</head>

<body>
    <div class="home__bg">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-warning bg-warning">
            <div class="container">
                <p class="navbar-brand font-weight-bold text-dark mb-0">AIA Batam</p>
                <img src="../Assets/img/logo.png" alt="logo" style="width: 2rem;">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
                    <div class="navbar-nav ml-auto">
                        <a class="nav-item nav-link active text-dark font-weight-bold" href="#">Home</a>
                        <a class="nav-item nav-link text-dark" href="./Salary/salary.php">Salary</a>
                        <a class="nav-item nav-link text-dark" href="./Employee/employee.php">Employee</a>
                        <a class="nav-item nav-link text-dark" href="./Department/department.php">Department</a>
                        <a class="nav-item nav-link text-dark" href="./Job/job.php">Job Roles</a>
                        <a class="nav-item nav-link text-dark" href="./Education/education.php">Educations</a>
                        <a href="../Model/Auth/logoutController.php" class="btn btn-light logout-btn ml-3">Logout <i class="fas fa-sign-out-alt"></i></a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Alerts -->
        <?php include '../Component/Alert.php' ?>
        <!-- Alerts -->

        <!-- Greeting -->
        <h4 class="font-weight-bold welcome-text text-center mt-5 mx-1">Welcome back, Team.</h4>
        <!-- Cards -->
        <div class="container mt-5 pb-5">
            <div class="row">
                <div class="col-md-4 col-sm-12 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="home__card-icon fas fa-users"></i>
                            <h5 class="card-title font-weight-bold mt-3 p-2 bg-warning" style="border-radius: 5px;">Employee</h5>
                            <p class="card-text">View employees in Company.</p>
                            <a href="./Employee/employee.php" class="btn btn-warning">Enter <i class="fas fa-door-open"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="home__card-icon fas fa-money-check-alt"></i>
                            <h5 class="card-title font-weight-bold mt-3 p-2 bg-warning" style="border-radius: 5px;">Salary</h5>
                            <p class="card-text">View your salary.</p>
                            <a href="./Salary/salary.php" class="btn btn-warning">Enter <i class="fas fa-door-open"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="home__card-icon fas fa-briefcase"></i>
                            <h5 class="card-title font-weight-bold mt-3 p-2 bg-warning" style="border-radius: 5px;">Department</h5>
                            <p class="card-text">View departments in company.</p>
                            <a href="./Department/department.php" class="btn btn-warning">Enter <i class="fas fa-door-open"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4 col-sm-12 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="home__card-icon fas fa-user-tag"></i>
                            <h5 class="card-title font-weight-bold mt-3 p-2 bg-warning" style="border-radius: 5px;">Job Roles</h5>
                            <p class="card-text">View Job Roles in company.</p>
                            <a href="./Job/job.php" class="btn btn-warning">Enter <i class="fas fa-door-open"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="home__card-icon fas fa-user-graduate"></i>
                            <h5 class="card-title font-weight-bold mt-3 p-2 bg-warning" style="border-radius: 5px;">Educations</h5>
                            <p class="card-text">View Educations in company.</p>
                            <a href="./Education/education.php" class="btn btn-warning">Enter <i class="fas fa-door-open"></i></a>
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
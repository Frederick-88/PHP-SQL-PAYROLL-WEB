<?php require_once '../../Model/Auth/loginController.php'; ?>
<?php if (!isset($_SESSION['login'])) {
    $_SESSION['response'] = "Hey there, please login first =)";
    $_SESSION['res-type'] = "danger";
    header('location: ../../View/login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./salaryUser.css">
    <title>Salary - User AIA</title>
</head>

<body style=" font-family: Questrial, sans-serif !important;" class="home__bg">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-warning bg-warning">
        <div class="container">
            <p class="navbar-brand font-weight-bold text-dark mb-0">AIA Batam</p>
            <img src="../../Assets/img/logo.png" alt="logo" style="width: 2rem;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link active text-dark font-weight-bold" href="../index.php">Home</a>
                    <a class="nav-item nav-link text-dark" href="#">Salary</a>
                    <a class="nav-item nav-link text-dark" href="../Employee/employee.php">Employee</a>
                    <a class="nav-item nav-link text-dark" href="../Department/department.php">Department</a>
                    <a class="nav-item nav-link text-dark" href="../Job/job.php">Job Roles</a>
                    <a class="nav-item nav-link text-dark" href="../Education/education.php">Educations</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="main-center-container">
            <div class="d-flex d-row mb-3">
                <h3 class="text-center salary-text my-0 mr-3">This is your salary info, Timo.</h3>
                <a href="../index.php" class="btn btn-primary">Back</a>
            </div>

            <div class=" d-flex justify-content-center">
                <div class="card salary-user-card">
                    <img class="card-img-top salary-user-card-image" src="https://png.pngtree.com/png-vector/20190321/ourlarge/pngtree-vector-users-icon-png-image_856952.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title text-center font-weight-bold">Timo Werner</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Year</th>
                                    <th scope="col">Month</th>
                                    <th scope="col">Salary</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>2020</td>
                                    <td>September</td>
                                    <td>3.800.000</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>2020</td>
                                    <td>October</td>
                                    <td>3.800.000</td>
                                </tr>
                            </tbody>
                        </table>
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
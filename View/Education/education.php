<?php require_once '../../Model/Auth/loginController.php'; ?>
<?php if (!isset($_SESSION['login'])) {
    header('location: ../../View/login.php?response=Hello, please login first.&res-type=danger');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="education.css">
    <title>Educations AIA</title>
</head>

<body style=" font-family: Questrial, sans-serif !important;">
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
                    <a class="nav-item nav-link text-dark" href="../Salary/salary.php">Salary</a>
                    <a class="nav-item nav-link text-dark" href="../Employee/employee.php">Employee</a>
                    <a class="nav-item nav-link text-dark" href="../Department/department.php">Department</a>
                    <a class="nav-item nav-link text-dark" href="../Job/job.php">Job Roles</a>
                    <a class="nav-item nav-link text-dark" href="#">Educations</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container my-5">
        <h3 class="text-center font-weight-bold mb-4">Educations Table Data <i class="fas fa-user-graduate ml-2"></i></h3>
        <!-- Alert -->
        <?php include '../../Component/Alert.php' ?>

        <div class="row">
            <div class="col-md-2 col-sm-12">
                <a href="../index.php" class="btn btn-primary">Back</a>
                <?php if ($_SESSION['role'] === 'admin') : ?>
                    <a href="./addEducation.php" class="btn btn-warning my-3">Add Education</a>
                <?php endif; ?>
            </div>
            <div class="col-md-10 col-sm-12 table-responsive">
                <p class="text-danger font-weight-bold my-0 d-lg-none d-md-none">*slide right to see more (for smaller screens)</p>
                <table class="table table-warning">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Education Term Name</th>
                            <th scope="col">Number of employees</th>
                            <?php if ($_SESSION['role'] === 'admin') : ?>
                                <th scope="col">Actions</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- PHP SCRIPT -->
                        <?php
                        $number = 1;
                        $queryTotalEducation = "SELECT COUNT(employee.id) AS matched_employee_education, education.id AS educationId, employee.dept_id, education.education_term 
                        FROM employee RIGHT JOIN education ON employee.education_id = education.id GROUP BY education.id";
                        $queryEducationEmployeeTotal = $connection->query($queryTotalEducation) or die($connection->error);
                        while ($fetchEducationData = $queryEducationEmployeeTotal->fetch_assoc()) {
                        ?>
                            <!-- PHP SCRIPT -->
                            <tr>
                                <th scope="row"><?= $number++ ?></th>
                                <td><?= $fetchEducationData['education_term'] ?></td>
                                <td><?= $fetchEducationData['matched_employee_education'] ?></td>
                                <?php if ($_SESSION['role'] === 'admin') : ?>
                                    <td>
                                        <a href="editEducation.php?editinfo=<?= $fetchEducationData['educationId'] ?>" class="btn btn-success edit-btn">Edit</a>
                                        <a href="../../Model/educationController.php?deleteEducation=<?= $fetchEducationData['educationId'] ?>" class="btn btn-danger" onclick="return confirm('Do you want to delete this education record ?')">Delete</a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>

</html>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
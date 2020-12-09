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
    <link rel="stylesheet" href="employee.css">
    <title>Employee AIA</title>
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
                    <a class="nav-item nav-link text-dark" href="#">Employee</a>
                    <a class="nav-item nav-link text-dark" href="../Department/department.php">Department</a>
                    <a class="nav-item nav-link text-dark" href="../Job/job.php">Job Roles</a>
                    <a class="nav-item nav-link text-dark" href="../Education/education.php">Educations</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container my-5">
        <h3 class="text-center font-weight-bold mb-4">Employee Table Data <i class="fas fa-users ml-2"></i></h3>
        <!-- ALERTS -->
        <?php include '../../Component/Alert.php' ?>

        <div>
            <div class="d-flex align-items-center mb-2">
                <h5 class="mb-0">Generate PDF here</h5>
                <i class="fas fa-arrow-alt-circle-down fa-lg ml-2"></i>
            </div>
            <div class="d-flex flex-wrap mb-3">
                <a href="../Pdf/employeeReport.php" class="btn btn-primary mr-3 mt-2">Generate All Employee</a>
                <form action="../Pdf/employeeReport.php" method="POST">
                    <select class="form-control mt-2" name="department-pdf" onchange="this.form.submit()" required>
                        <option disabled selected>Generate Employee by Department</option>
                        <?php
                        $data = mysqli_query($connection, "SELECT * FROM department") or die(mysqli_error($connection));

                        while ($departments = $data->fetch_assoc()) :
                        ?>
                            <option value="<?= $departments['dept_name'] ?>"><?= $departments['dept_code'] ?> - <?= $departments['dept_name'] ?></option>
                        <?php
                        endwhile;
                        ?>
                    </select>
                </form>
            </div>
            <hr>
            <a href="../index.php" class="btn btn-primary mb-3">Back</a>
            <?php if ($_SESSION['role'] === 'admin') : ?>
                <a href="./addEmployee.php" class="btn btn-warning mb-3">Add Employee</a>
            <?php endif; ?>
        </div>
        <div>
            <!-- PHP SCRIPT -->
            <div class="row">
                <?php
                $number = 1;
                $query = "SELECT *, employee.id AS employeeID FROM employee JOIN department ON employee.dept_id = department.id JOIN education ON employee.education_id = education.id JOIN job_position ON employee.job_position_id = job_position.id";
                $result = $connection->query($query);
                while ($fetchEmployeeData = $result->fetch_assoc()) {
                ?>
                    <!-- PHP SCRIPT -->
                    <div class="col-md-3 col-6">
                        <div class="card mb-4">
                            <?php if ($fetchEmployeeData['employee_photo']) { ?>
                                <img class="card-img-top employee-img" src="<?= $fetchEmployeeData['employee_photo'] ?>" alt="Employee Photo">
                            <?php } else { ?>
                                <img class="card-img-top employee-img" src="https://www.pngitem.com/pimgs/m/334-3344170_user-vector-user-flat-png-transparent-png.png" alt="Employee Photo">
                            <?php } ?>

                            <div class="card-body">
                                <h5 class="card-title font-weight-bold"><?= $fetchEmployeeData['name'] ?></h5>
                                <p class="card-text"><b>Employee-Number:</b> <?= $fetchEmployeeData['employee_number'] ?></p>
                                <p class="card-text"><b>Email:</b> <?= $fetchEmployeeData['email'] ?></p>
                                <p class="card-text"><b>Dept-Code:</b> <?= $fetchEmployeeData['dept_code'] ?></p>
                                <p class="card-text"><b>Dept-Name:</b> <?= $fetchEmployeeData['dept_name'] ?></p>
                                <p class="card-text"><b>Role:</b> <?= $fetchEmployeeData['job_label'] ?></p>
                                <p class="card-text"><b>Gender:</b> <?= $fetchEmployeeData['gender'] ?></p>
                                <p class="card-text"><b>Entry:</b> <?= $fetchEmployeeData['entry_date'] ?></p>
                                <p class="card-text"><b>Resign Date:</b> <?= $fetchEmployeeData['resign_date'] ? $fetchEmployeeData['resign_date'] : '-' ?></p>
                                <p class="card-text"><b>Education-Term:</b> <?= $fetchEmployeeData['education_term'] ?></p>
                                <p class="card-text"><b>Employee-Term:</b> <?= $fetchEmployeeData['employee_term'] ?></p>
                                <p class="card-text"><b>Birth:</b> <?= $fetchEmployeeData['birth_place'] ?>, <?= $fetchEmployeeData['birth_date'] ?></p>
                                <p class="card-text"><b>Address:</b> <?= $fetchEmployeeData['address'] ?></p>
                            </div>
                            <?php if ($_SESSION['role'] === 'admin') : ?>
                                <a href="../../Model/employeeController.php?deleteEmployee=<?= $fetchEmployeeData['employee_number'] ?>" class="icon-delete" onclick="return confirm('Do you want to delete this employee record ?')">
                                    <i class="fas fa-times-circle"></i>
                                </a>
                                <a href="./editEmployee.php?editinfo=<?= $fetchEmployeeData['employeeID'] ?>" class="icon-edit">
                                    <i class="fas fa-pen-square"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
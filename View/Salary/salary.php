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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="salaryAdmin.css">
    <link rel="stylesheet" href="./salaryUser.css">
    <title>Salary AIA</title>
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
    <!-- admin side -->
    <?php if ($_SESSION['role'] === 'admin') : ?>
        <div class="mx-5 my-5">
            <h3 class="text-center font-weight-bold mb-4">Salary Table Data</h3>
            <!-- ALERTS -->
            <?php include '../../Component/Alert.php' ?>

            <div class="row">
                <div class="col-md-2 col-sm-12">
                    <h5>Generate PDF here</h5>
                    <a href="../Pdf/salaryReport.php" class="btn btn-primary mb-3">Generate All Salary</a>
                    <h5>Generate By Month</h5>
                    <form action="../Pdf/salaryReport.php" method="POST">
                        <select class="form-control" name="month-pdf" onchange="this.form.submit()" required>
                            <option disabled selected>Select Month</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                    </form>
                    <hr>
                    <div class="mt-3">
                        <a href="../index.php" class="btn btn-primary mb-2">Back</a>
                        <a href="./addSalary.php" class="btn btn-warning mb-2">Add Salary</a>
                    </div>
                </div>
                <div class="col-md-10 col-sm-12 table-responsive ">
                    <p class="text-danger font-weight-bold my-0 d-lg-none">*slide right to see more (for smaller screens)</p>
                    <table class="table table-warning">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Employee-Number</th>
                                <th scope="col">Bank-Account</th>
                                <th scope="col">Month</th>
                                <th scope="col">Year</th>
                                <th scope="col">Gross-Salary</th>
                                <th scope="col">Tax</th>
                                <th scope="col">Net-Salary</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $number = 1;
                            $query = "SELECT *,salary.id AS salaryId FROM salary JOIN employee ON  salary.employee_number = employee.employee_number";
                            $result = $connection->query($query);
                            while ($fetchSalaryData = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $number++ ?></th>
                                    <td><?= $fetchSalaryData['name'] ?></td>
                                    <td><?= $fetchSalaryData['employee_number'] ?></td>
                                    <td><?= $fetchSalaryData['bank_account'] ?></td>
                                    <td><?= $fetchSalaryData['pay_month'] ?></td>
                                    <td><?= $fetchSalaryData['pay_year'] ?></td>
                                    <td><?= $fetchSalaryData['gross_salary'] ?></td>
                                    <td><?= $fetchSalaryData['tax'] ?>%</td>
                                    <!-- <td> ?= $fetchSalaryData['gross_salary'] * $fetchSalaryData['tax'] / 100 ? </td> -->
                                    <td><?= $fetchSalaryData['net_salary'] ?></td>
                                    <td>
                                        <a href="./editSalary.php?editinfo=<?= $fetchSalaryData['salaryId'] ?>" class="btn btn-success edit-btn">Edit</a>
                                        <a href="../../Model/salaryController.php?deleteSalary=<?= $fetchSalaryData['salaryId'] ?>" class="btn btn-danger" onclick="return confirm('Do you want to delete this salary record ?')">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <!-- user side -->
    <?php else : ?>
        <div class="container">
            <div class="main-center-container">
                <div class="d-flex d-row mb-3">
                    <?php
                    $emp_name = $_SESSION['emp-name'];
                    $number = 1;
                    $query = "SELECT * FROM employee WHERE employee.name = '$emp_name'";
                    $result = $connection->query($query) or die($connection->error);
                    if ($result->num_rows === 0) { ?>
                        <div class="d-block">
                            <a href="../index.php" class="btn btn-primary mb-2">Back</a>
                            <h5 class="py-2 px-4 bg-danger text-white">No Data Found, seems you didn't put work name properly. Please contact dev-team for updates</h5>
                        </div>
                        <?php } else {
                        while ($fetchName = $result->fetch_assoc()) {
                        ?>
                            <h3 class="text-center salary-text my-0 mr-3">This is your salary info, <?= $fetchName['name'] ?>.</h3>
                            <a href="../index.php" class="btn btn-primary">Back</a>
                </div>

                <div class=" d-flex justify-content-center">
                    <div class="card salary-user-card">
                        <img class="card-img-top salary-user-card-image" src="https://png.pngtree.com/png-vector/20190321/ourlarge/pngtree-vector-users-icon-png-image_856952.jpg" alt="Card image cap">
                        <div class="card-body">

                            <h4 class="card-title text-center font-weight-bold"><?= $fetchName['name'] ?></h4>
                    <?php }
                    } ?>
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
                            <?php
                            $emp_name = $_SESSION['emp-name'];
                            $number = 1;
                            $query = "SELECT * FROM salary JOIN employee ON salary.employee_number = employee.employee_number WHERE employee.name = '$emp_name'";
                            $result = $connection->query($query) or die($connection->error);
                            while ($fetchSalaryData = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $number++ ?></th>
                                    <td><?= $fetchSalaryData['pay_year'] ?></td>
                                    <td><?= $fetchSalaryData['pay_month'] ?></td>
                                    <td><?= $fetchSalaryData['net_salary'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
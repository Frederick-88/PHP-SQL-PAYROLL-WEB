<?php
require_once '../../Model/Auth/loginController.php';
require_once '/xampp/htdocs/PSW-SEM3/Payroll/Library/connection.php';
?>
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
    <title>Add Employee</title>
</head>

<body style=" font-family: Questrial, sans-serif !important;" class="bg-warning">
    <div class="container my-5">
        <h3 class="text-center font-weight-bold mt-5 mb-3">Add Employee Form</h3>
        <form action="../../Model/employeeController.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Employee-Number</label>
                <input type="number" name="emp-number" class="form-control" placeholder="Employee-Number" required>
            </div>
            <div class="form-group">
                <label>Employee Name</label>
                <input type="text" name="emp-name" class="form-control" placeholder="Employee Name" required>
            </div>
            <label>Employee Photo</label>
            <div class="custom-file mb-3">
                <input type="file" name="emp-photo" class="custom-file-input" accept="image/*">
                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
            </div>
            <div class="form-group">
                <label>Employee Email</label>
                <input type="text" name="email" class="form-control" placeholder="Employee Email" required>
            </div>
            <div class="form-group">
                <label>Department</label>
                <select class="form-control" name="department" required>
                    <option disabled selected>Select Department</option>
                    <?php
                    $data = mysqli_query($connection, "SELECT * FROM department") or die(mysqli_error($connection));

                    while ($departments = $data->fetch_assoc()) :
                    ?>
                        <option value="<?= $departments['id'] ?>"><?= $departments['dept_code'] ?> - <?= $departments['dept_name'] ?></option>
                    <?php
                    endwhile;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Job Role</label>
                <select class="form-control" name="job" required>
                    <option disabled selected>Select Job Role</option>
                    <?php
                    $data = mysqli_query($connection, "SELECT *,job_position.id AS jobId FROM job_position JOIN department ON job_position.dept_id = department.id") or die(mysqli_error($connection));

                    while ($roles = $data->fetch_assoc()) :
                    ?>
                        <option value="<?= $roles['jobId'] ?>"><?= $roles['dept_code'] ?> - <?= $roles['job_label'] ?></option>
                    <?php
                    endwhile;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Entry Date</label>
                <input type="date" name="entry-date" class="form-control" placeholder="Entry Date" required>
            </div>
            <div class="form-group">
                <label>Gender</label>
                <select class="form-control" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label>Birth Place</label>
                <input type="text" name="birth-place" class="form-control" placeholder="Birth Place" required>
            </div>
            <div class="form-group">
                <label>Birth Date</label>
                <input type="date" name="birth-date" class="form-control" placeholder="Birth Date" required>
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" class="form-control" placeholder="Address" required>
            </div>
            <div class="form-group">
                <label>Education</label>
                <select class="form-control" name="education" required>
                    <option disabled selected>Select Education</option>
                    <?php
                    require_once '/xampp/htdocs/PSW-SEM3/Payroll/Library/connection.php';
                    $data = $connection->query("SELECT * FROM education");

                    while ($educations = $data->fetch_assoc()) :
                    ?>
                        <option value="<?= $educations['id'] ?>"><?= $educations['education_term'] ?></option>
                    <?php
                    endwhile;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Employee Term</label>
                <input type="text" name="emp-term" class="form-control" placeholder="Employee Term" required>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <button type="submit" name="SubmitEmployeeData" class="btn btn-light font-weight-bold w-50">Submit <i class="fas fa-plus ml-1 text-dark"></i></button>
            </div>
            <a href="employee.php" class="btn btn-primary">Back</a>
        </form>
    </div>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
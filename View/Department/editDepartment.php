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
    <title>Edit Department</title>
</head>

<?php
include('/xampp/htdocs/PSW-SEM3/Payroll/Model/departmentController.php')
?>


<body style=" font-family: Questrial, sans-serif !important;" class="bg-warning">
    <div class="container mb-5">
        <h3 class="text-center font-weight-bold mt-5 mb-3">Edit Department Info</h3>
        <!-- change below -->
        <form action="../../Model/departmentController.php" method="POST">
            <input type="hidden" name="dept_id" value="<?= $dept_id ?>">
            <div class="form-group">
                <label>Department Code</label>
                <input type="text" name="dept_code" value="<?= $dept_code ?>" class="form-control" placeholder="Department Code" required>
            </div>
            <div class="form-group">
                <label>Department Name</label>
                <input type="text" name="dept_name" value="<?= $dept_name ?>" class="form-control" placeholder="Department Name" required>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <button type="submit" name="submitEditDepartment" class="btn btn-secondary w-50">Submit</button>
            </div>
            <a href="department.php" class="btn btn-primary">Back</a>
        </form>
    </div>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
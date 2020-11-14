<?php require_once '../../Model/loginController.php'; ?>
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
    <title>Edit Salary</title>
</head>

<?php
include('/xampp/htdocs/PSW-SEM3/Payroll/Model/salaryController.php')
?>

<body style=" font-family: Questrial, sans-serif !important;" class="bg-warning">
    <div class="container mb-5">
        <h3 class="text-center font-weight-bold mt-5 mb-3">Edit Salary Info</h3>
        <form action="../../Model/salaryController.php" method="POST">
            <div class="form-group">
                <input type="hidden" name="salary_id" value="<?= $salary_id ?>">
                <label>Employee Name</label>
                <select class="form-control" name="employee_number" required>
                    <option value="<?= $employee_number ?>" selected><?= $employee_name ?></option>
                    <?php
                    require_once '/xampp/htdocs/PSW-SEM3/Payroll/Library/connection.php';
                    $data = $connection->query("SELECT * FROM employee");
                    while ($employeeData = $data->fetch_assoc()) :
                    ?>
                        <option value="<?= $employeeData['employee_number'] ?>"><?= $employeeData['name'] ?></option>
                    <?php
                    endwhile;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Bank Account</label>
                <input type="number" value="<?= $bank_account ?>" name="bank_account" class="form-control" placeholder="Bank Account" required>
            </div>
            <div class="form-group">
                <label>Pay Month</label>
                <select class="form-control" name="pay_month" required>
                    <option value="<?= $pay_month ?>" selected><?= $pay_month ?></option>
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
            </div>
            <div class="form-group">
                <label>Pay Year</label>
                <input type="text" value="<?= $pay_year ?>" name="pay_year" class="form-control" placeholder="Pay Year" required>
            </div>
            <div class="form-group">
                <label>Gross Salary</label>
                <input type="text" name="gross_salary" value="<?= $gross_salary ?>" class="form-control" placeholder="Gross Salary" required>
            </div>
            <div class="form-group">
                <label>Tax</label>
                <input type="text" name="tax" value="<?= $tax ?>" class="form-control" placeholder="Tax" required>
            </div>
            <div class="form-group">
                <label>Net Salary</label>
                <input type="text" name="net_salary" value="<?= $net_salary ?>" class="form-control" placeholder="Net Salary" required>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <button type="submit" name="EditSalary" class="btn btn-success w-50">Edit</button>
            </div>
            <a href="salaryAdmin.php" class="btn btn-primary">Back</a>
        </form>
    </div>
    </div>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php
// sometimes there will be error, if not route from the root path ('/'), so try this :)
include('/xampp/htdocs/PSW-SEM3/Payroll/Library/connection.php');

$salary_id = '';
$employee_number = '';
$employee_name = '';
$bank_account = '';
$pay_month = '';
$pay_year = '';
$gross_salary = '';
$tax = '';
$net_salary = '';

if (isset($_POST['submitAddSalary'])) {
    $employee_number = $_POST['employee_number'];
    $bank_account = $_POST['bank_account'];
    $pay_month = $_POST['pay_month'];
    $pay_year = $_POST['pay_year'];
    $gross_salary = $_POST['gross_salary'];
    $tax = $_POST['tax'];
    $net_salary = $_POST['net_salary'];
    // insert data to table
    mysqli_query($connection, "INSERT INTO salary (employee_number, bank_account, pay_month, pay_year, gross_salary, tax, net_salary) VALUES('$employee_number', '$bank_account','$pay_month','$pay_year', '$gross_salary', '$tax', '$net_salary') ") or die(mysqli_error($connection));

    header("location: ../View/Salary/salaryAdmin.php?response=New Salary Info has been added&res-type=success");
}
if (isset($_GET['editinfo'])) {
    $id = $_GET['editinfo'];

    $query = "SELECT *,salary.id AS salaryId FROM salary JOIN employee ON salary.employee_number = employee.employee_number WHERE salary.id=$id";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $salary = $result->fetch_assoc();

    $salary_id = $salary['salaryId'];
    $employee_number = $salary['employee_number'];
    $employee_name = $salary['name'];
    $bank_account = $salary['bank_account'];
    $pay_month = $salary['pay_month'];
    $pay_year = $salary['pay_year'];
    $gross_salary = $salary['gross_salary'];
    $tax = $salary['tax'];
    $net_salary = $salary['net_salary'];
}
if (isset($_POST['EditSalary'])) {
    $salary_id = $_POST['salary_id'];
    $employee_number = $_POST['employee_number'];
    $bank_account = $_POST['bank_account'];
    $pay_month = $_POST['pay_month'];
    $pay_year = $_POST['pay_year'];
    $gross_salary = $_POST['gross_salary'];
    $tax = $_POST['tax'];
    $net_salary = $_POST['net_salary'];

    // update table data 2nd way - mysqli way --- BETTER
    mysqli_query($connection, "UPDATE salary SET employee_number='$employee_number', bank_account='$bank_account', pay_month='$pay_month', pay_year='$pay_year', gross_salary='$gross_salary', tax='$tax', net_salary='$net_salary' WHERE id=$salary_id") or die(mysqli_error($connection));

    // update table data 3rd way
    // if ($connection->query($query) === TRUE) {
    //     echo "Record updated successfully";
    // } else {
    //     echo "Error updating record: " . $connection->error;
    // }

    // update table data - PDO way
    // $query = ("UPDATE salary SET employee_id='$employee_id', gross_salary='$gross_salary', tax='$tax', net_salary='$net_salary, date='$date' WHERE id=$salary_id");
    // $statement = $connection->prepare($query);
    // $statement->execute();

    header("location: ../View/Salary/salaryAdmin.php?response=Successfully Updated Salary Record&res-type=success");
}
if (isset($_GET['deleteSalary'])) {
    $id = $_GET['deleteSalary'];

    $query = "DELETE FROM salary WHERE id=$id";
    $statement = mysqli_query($connection, $query) or die(mysqli_error($connection));

    header("location: ../View/Salary/salaryAdmin.php?response=Successfully Deleted Salary Record&res-type=danger");
}

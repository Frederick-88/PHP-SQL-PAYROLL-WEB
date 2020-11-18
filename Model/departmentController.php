<?php
// sometimes there will be error, if not route from the root path ('/'), so try this :)
include('/xampp/htdocs/PSW-SEM3/Payroll/Library/connection.php');

$dept_id = '';
$dept_code = '';
$dept_name = '';

if (isset($_POST['submitAddDepartment'])) {
    $dept_code = $_POST['dept_code'];
    $dept_name = $_POST['dept_name'];

    // insert data to table
    mysqli_query($connection, "INSERT INTO department (dept_code, dept_name) VALUES('$dept_code','$dept_name') ") or die(mysqli_error($connection));

    header("location: ../View/Department/department.php?response=New Department has been added&res-type=success");
}
if (isset($_GET['editinfo'])) {
    $id = $_GET['editinfo'];

    $query = "SELECT * FROM department WHERE id=$id";
    $result = $connection->query($query);
    $department = $result->fetch_assoc();

    $dept_id = $department['id'];
    $dept_code = $department['dept_code'];
    $dept_name = $department['dept_name'];
}
if (isset($_POST['submitEditDepartment'])) {
    $dept_id = $_POST['dept_id'];
    $dept_code = $_POST['dept_code'];
    $dept_name = $_POST['dept_name'];

    echo $dept_id, $dept_code, $dept_name;
    // update table data 2nd way - mysqli way --- BETTER
    mysqli_query($connection, "UPDATE department SET dept_code='$dept_code', dept_name='$dept_name' WHERE id=$dept_id") or die(mysqli_error($connection));

    header("location: ../View/Department/department.php?response=Successfully Updated Department Record&res-type=success");
}
if (isset($_GET['deleteDepartment'])) {
    $id = $_GET['deleteDepartment'];

    $query = "DELETE FROM department WHERE id=$id";
    $statement = mysqli_query($connection, $query) or die(mysqli_error($connection));

    header("location: ../View/Department/department.php?response=Successfully Deleted Department Record&res-type=danger");
}

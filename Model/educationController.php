<?php
// sometimes there will be error, if not route from the root path ('/'), so try this :)
include('/xampp/htdocs/PSW-SEM3/Payroll/Library/connection.php');

$education_id = '';
$education_term = '';

if (isset($_POST['submitAddEducation'])) {
    $education_term = $_POST['education_term'];

    // insert data to table
    mysqli_query($connection, "INSERT INTO education (education_term) VALUES('$education_term') ") or die(mysqli_error($connection));

    header("location: ../View/Education/education.php?response=New Education has been added&res-type=success");
}

if (isset($_GET['editinfo'])) {
    $id = $_GET['editinfo'];

    $query = "SELECT * FROM education WHERE id=$id";
    $result = $connection->query($query);
    $education = $result->fetch_assoc();

    $education_id = $education['id'];
    $education_term = $education['education_term'];
}
if (isset($_POST['submitEditEducation'])) {
    $education_id = $_POST['education_id'];
    $education_term = $_POST['education_term'];

    // update table data 2nd way - mysqli way --- BETTER
    mysqli_query($connection, "UPDATE education SET education_term='$education_term' WHERE id=$education_id") or die(mysqli_error($connection));

    header("location: ../View/Education/education.php?response=Successfully Updated Education Record&res-type=success");
}

if (isset($_GET['deleteEducation'])) {
    $id = $_GET['deleteEducation'];

    $query = "DELETE FROM education WHERE id=$id";
    $statement = mysqli_query($connection, $query) or die(mysqli_error($connection));

    header("location: ../View/Education/education.php?response=Successfully Deleted Education Record&res-type=danger");
}

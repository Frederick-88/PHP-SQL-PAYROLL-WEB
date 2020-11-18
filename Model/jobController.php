<?php
// sometimes there will be error, if not route from the root path ('/'), so try this :)
include('/xampp/htdocs/PSW-SEM3/Payroll/Library/connection.php');

$job_id = '';
$dept_id = '';
$dept_id = '';
$job_label = '';

if (isset($_POST['submitAddJob'])) {
    $dept_id = $_POST['dept_id'];
    $job_label = $_POST['job_label'];

    // insert data to table
    mysqli_query($connection, "INSERT INTO job_position (dept_id, job_label) VALUES('$dept_id','$job_label') ") or die(mysqli_error($connection));

    header("location: ../View/Job/job.php?response=New Job has been added&res-type=success");
}

if (isset($_GET['editinfo'])) {
    $id = $_GET['editinfo'];

    $query = "SELECT * FROM job_position WHERE id=$id";

    $result = $connection->query($query);
    $job = $result->fetch_assoc();

    $job_id = $job['id'];
    $job_label = $job['job_label'];
}
if (isset($_POST['submitEditJob'])) {
    $job_id = $_POST['job_id'];
    $dept_id = $_POST['dept_id'];
    $job_label = $_POST['job_label'];

    // update table data 2nd way - mysqli way --- BETTER
    mysqli_query($connection, "UPDATE job_position SET dept_id='$dept_id', job_label='$job_label' WHERE id=$job_id") or die(mysqli_error($connection));

    header("location: ../View/Job/job.php?response=Successfully Updated Job Record&res-type=success");
}

if (isset($_GET['deleteJob'])) {
    $id = $_GET['deleteJob'];

    $query = "DELETE FROM job_position WHERE id=$id";
    $statement = mysqli_query($connection, $query) or die(mysqli_error($connection));

    header("location: ../View/Job/job.php?response=Successfully Deleted Job Record&res-type=danger");
}

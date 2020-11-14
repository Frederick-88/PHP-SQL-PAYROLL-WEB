<?php
// sometimes there will be error, if not route from the root path ('/'), so try this :)
include('/xampp/htdocs/PSW-SEM3/Payroll/Library/connection.php');

session_start();

$job_id = '';
$dept_id = '';
$dept_code = '';
$job_label = '';

if (isset($_POST['submitAddJob'])) {
    $dept_code = $_POST['dept_code'];
    $job_label = $_POST['job_label'];

    // insert data to table
    mysqli_query($connection, "INSERT INTO job_position (dept_code, job_label) VALUES('$dept_code','$job_label') ") or die(mysqli_error($connection));

    $_SESSION['response']    = "New Job has been added";
    $_SESSION['res-type']   = "success";

    header("location: ../View/Job/job.php");
}

if (isset($_GET['editinfo'])) {
    $id = $_GET['editinfo'];

    $query = "SELECT * FROM job_position";

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

    $_SESSION['response']    = "Successfully Updated Job Record";
    $_SESSION['res-type']   = "success";

    header("location: ../View/Job/job.php");
}

if (isset($_GET['deleteJob'])) {
    $id = $_GET['deleteJob'];

    $query = "DELETE FROM job_position WHERE id=$id";
    $statement = mysqli_query($connection, $query) or die(mysqli_error($connection));

    $_SESSION['response'] = "Successfully Deleted Job Record";
    $_SESSION['res-type'] = "danger";
    header("location: ../View/Job/job.php");
}

<?php
// sometimes there will be error, if not route from the root path ('/'), so try this :)
include('/xampp/htdocs/PSW-SEM3/Payroll/Library/connection.php');

$employee_id = '';
// --------------------------
$employee_number = '';
$name = '';
$employee_photo = '';
$email = '';
$dept_id = '';
$job_position_id = '';
$entry_date = '';
$resign_date = '';
$gender = '';
$birth_place = '';
$birth_date = '';
$address = '';
$education_id = '';
$employee_term = '';

if (isset($_POST['SubmitEmployeeData'])) {
    // get other data
    $employee_number = $_POST['emp-number'];
    $name = $_POST['emp-name'];
    $email = $_POST['email'];
    $dept_id = $_POST['department'];
    $job_position_id = $_POST['job'];
    $entry_date = $_POST['entry-date'];
    $gender = $_POST['gender'];
    $birth_place = $_POST['birth-place'];
    $birth_date = $_POST['birth-date'];
    $address = $_POST['address'];
    $education_id = $_POST['education'];
    $employee_term = $_POST['emp-term'];

    // check if there is file upload
    if ($_FILES["emp-photo"]["error"] === 4) {
        $photoInHtml = null;
    } else {
        $image = $_FILES['emp-photo']['name'];
        $explode = explode('.', $image);
        $ext = end($explode);
        $photo = '../Model/userImages/' . $name . '.' . $ext;
        $photoInHtml = '../../Model/userImages/' . $name . '.' . $ext;

        move_uploaded_file($_FILES['emp-photo']['tmp_name'], $photo);
    }

    // insert data to table employee DB payroll.
    mysqli_query($connection, "INSERT INTO employee (employee_number, employee_photo, name, email, dept_id ,job_position_id ,entry_date, gender, birth_place, birth_date, address, education_id, employee_term) VALUES('$employee_number','$photoInHtml', '$name','$email','$dept_id', '$job_position_id','$entry_date','$gender', '$birth_place', '$birth_date','$address', '$education_id', '$employee_term') ") or die(mysqli_error($connection));

    // redirect back to employee page
    header("location: ../View/Employee/employee.php?response=New Employee has been added&res-type=success");
}
if (isset($_POST['EditEmployeeData'])) {
    // get other data
    $employee_id = $_POST['emp-id'];
    $employee_number = $_POST['emp-number'];
    $name = $_POST['emp-name'];
    $old_image = $_POST['old-image'];
    $email = $_POST['email'];
    $dept_id = $_POST['department'];
    $job_position_id = $_POST['job'];
    $entry_date = $_POST['entry-date'];
    $resign_date = $_POST['resign-date'];
    $gender = $_POST['gender'];
    $birth_place = $_POST['birth-place'];
    $birth_date = $_POST['birth-date'];
    $address = $_POST['address'];
    $education_id = $_POST['education'];
    $employee_term = $_POST['emp-term'];


    // check if there is file upload
    if ($_FILES["emp-photo"]["error"] === 4) {
        $photoInHtml = $old_image;
    } else {
        $image = $_FILES['emp-photo']['name'];

        $explode = explode('.', $image);
        $ext = end($explode);
        $photo = '../Model/userImages/' . $name . '.' . $ext;
        $photoInHtml = '../../Model/userImages/' . $name . '.' . $ext;

        move_uploaded_file($_FILES['emp-photo']['tmp_name'], $photo);
    }

    // insert data to table employee DB payroll.
    if (!$resign_date) {
        mysqli_query($connection, "UPDATE employee SET employee_number='$employee_number', employee_photo='$photoInHtml', name='$name', email='$email', dept_id='$dept_id', job_position_id='$job_position_id', entry_date='$entry_date', resign_date=null, gender='$gender', birth_place='$birth_place', birth_date='$birth_date', address='$address', education_id='$education_id', employee_term='$employee_term' WHERE id=$employee_id") or die(mysqli_error($connection));
    } else {
        mysqli_query($connection, "UPDATE employee SET employee_number='$employee_number', employee_photo='$photoInHtml', name='$name', email='$email', dept_id='$dept_id', job_position_id='$job_position_id', entry_date='$entry_date', resign_date='$resign_date', gender='$gender', birth_place='$birth_place', birth_date='$birth_date', address='$address', education_id='$education_id', employee_term='$employee_term' WHERE id=$employee_id") or die(mysqli_error($connection));
    }

    // redirect back to employee page
    header("location: ../View/Employee/employee.php?response=Successfully Updated Employee Record&res-type=success");
}
if (isset($_GET['editinfo'])) {
    $id = $_GET['editinfo'];

    $query = "SELECT * FROM employee WHERE id=$id";
    $result = $connection->query($query);
    $employee = $result->fetch_assoc();

    $employee_id = $id;
    $employee_number = $employee['employee_number'];
    $name = $employee['name'];
    $employee_photo = $employee['employee_photo'];;
    $email = $employee['email'];
    $entry_date = $employee['entry_date'];
    $resign_date = $employee['resign_date'];
    $gender = $employee['gender'];
    $birth_place = $employee['birth_place'];
    $birth_date = $employee['birth_date'];
    $address = $employee['address'];
    $employee_term = $employee['employee_term'];
}

if (isset($_GET['deleteEmployee'])) {
    $employee_number = $_GET['deleteEmployee'];

    $query = "DELETE FROM employee WHERE employee_number=$employee_number";
    $statement = mysqli_query($connection, $query) or die(mysqli_error($connection));

    // redirect back to employee page
    header("location: ../View/Employee/employee.php?response=Successfully Deleted Employee Record&res-type=danger");
}

<?php ob_start();
include('connection.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <style>
        .pdf-title {
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            margin-bottom: 1rem;
        }

        .pdf-report {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        .pdf-report td,
        .pdf-report th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        /* select the child with even number/index/column */
        .pdf-report tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .pdf-report th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #FFC107;
            color: white;
        }
    </style>
    <title>AIA PDF REPORT</title>
</head>

<body>
    <h2 class="pdf-title">AIA EMPLOYEES DATA</h2>
    <table class="pdf-report">
        <tr>
            <th>Employee</th>
            <th>Entry-Date</th>
            <th>Department</th>
            <th>Job-Position</th>
        </tr>
        <?php
        $selectedDepartment = isset($_POST['department-pdf']) ? $_POST['department-pdf'] : '';
        $number = 1;

        $queryEmployeeSpecificMonth = "SELECT * FROM employee JOIN department ON employee.dept_id = department.id JOIN education ON employee.education_id = education.id JOIN job_position ON employee.job_position_id = job_position.id WHERE department.dept_name = '$selectedDepartment'";
        $queryEmployee = "SELECT * FROM employee JOIN department ON employee.dept_id = department.id JOIN education ON employee.education_id = education.id JOIN job_position ON employee.job_position_id = job_position.id";
        $fetchEmployee = $connection->query($selectedDepartment === '' ? $queryEmployee : $queryEmployeeSpecificMonth) or die(mysqli_error($connection));
        if ($fetchEmployee->num_rows === 0) { ?>
            <tr>
                <td>No Employee Found</td>
                <td>No Entry Date Found</td>
                <td>No Department Found</td>
                <td>No Job Position Found</td>
            </tr>
            <?php } else {
            while ($employee = mysqli_fetch_array($fetchEmployee)) {
            ?>
                <tr>
                    <td><?= $employee['name'] . "-" . $employee['employee_number'] . "-" . $employee['employee_term'] ?></td>
                    <td><?= $employee['entry_date'] ?></td>
                    <td><?= $employee['dept_code'] ?></td>
                    <td><?= $employee['job_label'] ?></td>
                </tr>
        <?php }
        } ?>
    </table>
</body>

</html>

<?php
include('connection.php');
require_once("dompdf/autoload.inc.php");

use Dompdf\Dompdf;

$html = ob_get_clean();
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('AIA-Employees-Data.pdf');

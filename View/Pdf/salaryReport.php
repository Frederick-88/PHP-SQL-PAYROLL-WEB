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
    <h2 class="pdf-title">AIA Salary DATA</h2>
    <table class="pdf-report">
        <tr>
            <th>Employee</th>
            <th>Bank-Account</th>
            <th>Period</th>
            <th>Paid Salary</th>
        </tr>
        <?php
        $selectedMonth = isset($_GET['month']) ? $_GET['month'] : '';
        $number = 1;

        $querySalarySpecificMonth = "SELECT * FROM salary JOIN employee ON  salary.employee_number = employee.employee_number WHERE salary.pay_month = '$selectedMonth'";
        $querySalary = "SELECT * FROM salary JOIN employee ON  salary.employee_number = employee.employee_number";
        $fetchSalary = $connection->query($selectedMonth === '' ? $querySalary : $querySalarySpecificMonth) or die(mysqli_error($connection));
        while ($salary = mysqli_fetch_array($fetchSalary)) {
        ?>
            <tr>
                <td><?= $salary['name'] . "-" . $salary['employee_number'] ?></td>
                <td><?= $salary['bank_account'] ?></td>
                <td><?= $salary['pay_year'] . "-" . $salary['pay_month'] ?></td>
                <td><?= $salary['net_salary'] ?></td>
            </tr>
        <?php } ?>
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
$dompdf->stream('AIA-Salary-Data.pdf');

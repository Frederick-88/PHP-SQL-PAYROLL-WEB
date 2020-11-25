<?php
include('connection.php');
require_once("dompdf/autoload.inc.php");

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$query = mysqli_query($connection, "select * from employee");
$html = '<center><h3>Employee Lists</h3></center><hr/><br/>';
$html .= '<table border="1" width="100%">
 <tr>
 <th style="border: 1px solid #ddd; padding: 8px;">No</th>
 <th style="border: 1px solid blue; padding: 8px;">Name</th>
 <th style="border: 1px solid #ddd; padding: 8px;">Email</th>
 <th style="border: 1px solid red; padding: 8px;">Entry-Date</th>
 </tr>';
$no = 1;
while ($employee = mysqli_fetch_array($query)) {
    $html .= "<tr>
 <td>" . $no . "</td>
 <td>" . $employee['name'] . "</td>
 <td>" . $employee['email'] . "</td>
 <td>" . $employee['entry_date'] . "</td>
 </tr>";
    $no++;
}
$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('laporan_siswa.pdf');

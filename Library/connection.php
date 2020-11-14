<?php
$connection = new mysqli('localhost', 'root', '', 'payroll');

if ($connection->connect_error) {
    die('Could not connect the database' . $connection->connect_error);
}

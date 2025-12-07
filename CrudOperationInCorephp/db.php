<?php
$serverName = "AMAN\\SQLEXPRESS";
$connectionOptions = [
    "Database" => "studentDB",
    "Uid" => "aman",
    "PWD" => "aman",
    "TrustServerCertificate" => true
];

$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die("Database Not Connected!");
}
?>

<?php
include 'db.php';

if (!isset($_GET['id'])) {
    echo "INVALID REQUEST";
    exit();
}

$id = $_GET['id'];

$sql = "SELECT pdffile FROM students WHERE id=?";
$stmt = sqlsrv_query($conn, $sql, array($id));

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

if ($row['pdffile'] == NULL) {
    echo "NO PDF UPLOADED";
    exit();
}

// File path stored in database
$filePath = $row['pdffile'];

if (!file_exists($filePath)) {
    echo "FILE NOT FOUND";
    exit();
}

// Read file content
header("Content-Type: application/pdf");
header("Content-Disposition: inline; filename=\"student.pdf\"");
readfile($row['pdffile']);
exit;
?>

<?php
include 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM Students WHERE ID = ?";
$stmt = sqlsrv_query($conn, $sql, [$id]);

header("Location: index.php");
exit;
?>

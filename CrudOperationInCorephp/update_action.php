<?php
include 'db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: Student ID Missing!");
}

$id = intval($_GET['id']);

$name = $_POST['name'];
$email = $_POST['email'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$password = $_POST['password'];
$stream = $_POST['stream'];
$city = $_POST['city'];

if (!empty($dob)) {
    $dob = date('Y-m-d', strtotime($dob));
}

if (!empty($_FILES['pdf']['name'])) {

    $pdfData = file_get_contents($_FILES['pdf']['tmp_name']);

    $sql = "UPDATE students 
            SET Name=?, Email=?, DOB=?, Gender=?, Password=?, Stream=?, City=?, PDFFile=? 
            WHERE ID=?";
    
    $params = array(
        $name, $email, $dob, $gender, $password, $stream, $city,
        array($pdfData, SQLSRV_PARAM_IN, SQLSRV_PHPTYPE_STREAM(SQLSRV_ENC_BINARY), SQLSRV_SQLTYPE_VARBINARY('max')),
        $id
    );

} else {

    $sql = "UPDATE students 
            SET Name=?, Email=?, DOB=?, Gender=?, Password=?, Stream=?, City=? 
            WHERE ID=?";
    
    $params = array($name, $email, $dob, $gender, $password, $stream, $city, $id);
}

$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    echo "<span style='color:red;'>Update Failed ❌</span><br>";
    print_r(sqlsrv_errors());
} else {
    echo "<h3 style='color:green;'>Record Updated Successfully ✔</h3>";
    echo "<a href='index.php'>Back To Home</a>";
}
?>

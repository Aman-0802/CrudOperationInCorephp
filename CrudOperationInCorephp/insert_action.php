<?php
include 'db.php';

// Collect form data
$name = $_POST['name'];
$email = $_POST['email'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$password = $_POST['password'];
$stream = $_POST['stream'];
$city = $_POST['city'];

$pdfPath = null;

// Check if file is uploaded without error
if (isset($_FILES['PDFFile']) && $_FILES['PDFFile']['error'] == 0) {
    $uploadDir = 'uploads/'; // folder inside your project
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // create folder if it doesn't exist
    }

    // Get file extension
    $fileExt = pathinfo($_FILES['PDFFile']['name'], PATHINFO_EXTENSION);

    // Generate unique filename using uniqid() + random bytes
    $fileName = uniqid('pdf_', true) . '.' . $fileExt;
    $targetFilePath = $uploadDir . $fileName;

    // Move uploaded file to the folder
    if (move_uploaded_file($_FILES['PDFFile']['tmp_name'], $targetFilePath)) {
        $pdfPath = $targetFilePath; // store path to insert into DB
    } else {
        die("Failed to upload file ❌");
    }
}

// Insert data into database with PDF path
$sql = "INSERT INTO students (name, email, dob, gender, password, stream, city, PDFFile)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$params = array($name, $email, $dob, $gender, $password, $stream, $city, $pdfPath);

$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt) {
    echo "Inserted Successfully 🎯";
} else {
    die(print_r(sqlsrv_errors(), true));
}
?>
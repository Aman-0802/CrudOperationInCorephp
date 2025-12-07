<?php
include 'db.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Invalid Request!";
    exit();
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM students WHERE ID = ?";
$stmt = sqlsrv_query($conn, $sql, array($id), array("Scrollable" => SQLSRV_CURSOR_KEYSET));

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

if (sqlsrv_num_rows($stmt) === 0) {
    echo "Record Not Found!";
    exit();
}

$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

// Handle DOB safely
$dobValue = "";
if (!empty($row['DOB'])) {
    $dobValue = $row['DOB']->format('Y-m-d');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Student</title>
</head>
<body>
<center>

<h1>UPDATE STUDENT</h1><br><br>

<form action="update_action.php?id=<?php echo $row['ID']; ?>" method="POST" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?php echo $row['ID']; ?>">

Name: <input type="text" name="name" value="<?php echo $row['Name']; ?>" required><br><br>
Email: <input type="email" name="email" value="<?php echo $row['Email']; ?>" required><br><br>

DOB: <input type="date" name="dob" value="<?php echo $dobValue; ?>" required><br><br>

Gender:
<input type="radio" name="gender" value="Male" <?php echo ($row['Gender']=="Male")?"checked":""; ?>> Male
<input type="radio" name="gender" value="Female" <?php echo ($row['Gender']=="Female")?"checked":""; ?>> Female
<br><br>

Password: <input type="text" name="password" value="<?php echo $row['Password']; ?>" required><br><br>

Stream:
<select name="stream" required>
    <option value="SCIENCE" <?php echo ($row['Stream']=="SCIENCE")?"selected":""; ?>>SCIENCE</option>
    <option value="COMMERCE" <?php echo ($row['Stream']=="COMMERCE")?"selected":""; ?>>COMMERCE</option>
    <option value="ARTS" <?php echo ($row['Stream']=="ARTS")?"selected":""; ?>>ARTS</option>
</select>
<br><br>

City: <input type="text" name="city" value="<?php echo $row['City']; ?>" required><br><br>

Upload New Resume (PDF Only):
<input type="file" name="pdf"><br><br>

<button type="submit">Update</button>

</form>

<br>
<a href="index.php">Back</a>

</center>
</body>
</html>

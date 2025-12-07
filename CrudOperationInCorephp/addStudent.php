<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD STUDENT</title>
</head>

<body>
    <center>
        <h1> REGISTRATION FORM FOR STUDENT</h1>
        <br><br>

        <form action="insert_action.php" method="POST" enctype="multipart/form-data">
            Name: <input type="text" name="name" required><br><br>
            Email: <input type="email" name="email" required><br><br>

            DOB: <input type="date" name="dob" placeholder="YYYY-MM-DD" required><br><br>

            Gender:
            <input type="radio" name="gender" value="Male" required> Male
            <input type="radio" name="gender" value="Female" required> Female
            <br><br>

            Password: <input type="password" name="password" required><br><br>

            Stream:
            <select name="stream" required>
                <option value="SCIENCE">SCIENCE</option>
                <option value="COMMERCE">COMMERCE</option>
                <option value="ARTS">ARTS</option>
            </select>
            <br><br>

            City: <input type="text" name="city" required><br><br>

            Upload Resume (PDF Only) :
            <input type="file" name="PDFFile" accept="pdf"><br><br>

            <button type="submit">Save</button>

        </form>

        <a href="index.php">Back</a>
    </center>
</body>

</html>
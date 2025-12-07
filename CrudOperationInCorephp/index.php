<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <title>All Students</title>
</head>

<body>
    <center>
        <h2>All Students</h2>
        <a href="addStudent.php">+ Add Student</a><br><br>

        <table border="1" cellpadding="10">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>DOB</th>
                <th>Gender</th>
                <th>Password</th>
                <th>Stream</th>
                <th>City</th>
                <th>PDF</th>
                <th>Action</th>
            </tr>

            <?php
            $sql = "SELECT * FROM students"; // Table name sahi rakho
            $stmt = sqlsrv_query($conn, $sql);

            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }

            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            ?>
                <tr>
                    <td><?= $row['ID'] ?></td>
                    <td><?= $row['Name'] ?></td>
                    <td><?= $row['Email'] ?></td>

                    <td>
                        <?= isset($row['DOB']) && $row['DOB'] instanceof DateTime
                            ? $row['DOB']->format('Y-m-d')
                            : '' ?>
                    </td>

                    <td><?= $row['Gender'] ?></td>
                    <td><?= $row['Password'] ?></td>
                    <td><?= $row['Stream'] ?></td>
                    <td><?= $row['City'] ?></td>

                    <td>
                        <?php if (!empty($row['PDFFile'])) { ?>
                            <a href="viewpdf.php?id=<?= $row['ID'] ?>">View PDF</a>
                        <?php } else {
                            echo "No File";
                        } ?>
                    </td>

                    <td>
                        <a href="updateStudent.php?id=<?= $row['ID'] ?>">Edit</a> |
                        <a href="deleteStudent.php?id=<?= $row['ID'] ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>

        </table>
        <center>
</body>

</html>